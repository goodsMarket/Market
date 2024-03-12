<?php

namespace App\Http\Controllers;

use App\Models\BoardImg;
use App\Models\UsedTrade;
use App\Models\User;
use App\Modules\CallModel;
use App\Modules\MyModule;
use App\Modules\ImageModule;
use App\Modules\UserIdModule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Intervention\Image;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

/**
 * index(): 리스트 출력 틀
 * view(): 게시글 하나 조회 툴
 * store(): 게시글 작성 툴
 * update(): 게시글 수정 툴
 * delete(): 게시글 삭제 툴
 * index_deleted(): 삭제된 리스트 출력 툴
 * view_deleted(): 삭제된 게시글 하나 조회 툴
 */
class BoardController extends Controller
{
    protected array|UploadedFile|null $imageFile;
    protected array|string|null $cookie = '';
    protected array $callPacakge = []; // 모델, 페이지당 레코드 수, 뽑을 방법(함수)
    protected bool $hasImageFile;
    protected object $boardType;
    protected array $safeData; // 수정, 작성용 데이터
    protected int $boardPages = 5; // 페이지 묶음: 한번에 몇 페이지 출력할지
    protected int $boardPage;
    protected int $boardId;

    /**
     * 메인 출력 틀
     * 
     * 요구멤버: $callPacakge, $cookie
     * @return array|bool $lists = [$list]|[$list, $leftPages]
     */
    protected function index()
    {
        $list = [];
        $lists = [];
        isset($this->cookie) ? $cookie = $this->cookie : '';
        
        foreach ($this->callPacakge as $table => $counts) {
            foreach ($counts as $count => $methods) {
                foreach ($methods as $method) {
                    // --- 레코드 가져오기 ---
                    $callModel = new CallModel($table, $cookie);
                    $list = $callModel->$method($count);

                    // 빈배열인지, 0개 반환 객체인지
                    !empty($list) ? 
                    !empty($list->count()) ? 
                    $lists[$table][$method] = $list : 
                    $lists[$table][$method] = [] : 
                    $lists[$table][$method] = [] ;
                }
            }
        }

        return $lists;
    }

    /**
     * 리스트 출력 틀
     * 
     * 요구멤버: $callPacakge, $boardPage, $cookie
     * @return array|bool $lists = [$list]|[$list, $leftPages]
     */
    protected function list()
    {
        $list = [];

        // 음수값 오면 첫페이지로
        $this->boardPage < 1 ? $this->boardPage = 1 : '';

        foreach ($this->callPacakge as $key => $value) {
            // 뽑기 시작할 레코드 번수
            $offset = ($this->boardPage - 1) * $value[1];

            // --- 레코드 가져오기 ---
            $funcName = $value[2];
            $list = CallModel::$funcName([$value[0], $value[1]], $offset);

            if (empty($list->count())) {
                return false;
            }

            // --- 페이지 묶음 출력 분기 --- // 모듈로 빼놓기
            // 전체 레코드
            $records = $value[0]::count();

            // 페이지 총 개수
            $pages = ceil($records / $value[1]);

            // 몇개만 출력?
            $leftPages = $pages % $this->boardPages;

            // 출력에 변동이 있는지 없는지 // 현재 페이지 >= 안맞아떨어지기 시작하는 페이지
            $nowPage = $offset / $value[1];
            $lists[] = $nowPage >= $pages - $leftPages ? ['list' => $list, 'leftPages' => $leftPages] : [$funcName => $list];
        }

        return $lists;
    }

    /**
     * 게시글 개별 출력 틀
     * 
     * 요구멤버: $boardType, $boardId
     * @return \Illuminate\Http\JsonResponse
     */
    protected function view()
    {
        try {
            $result = $this->boardType::find($this->boardId);

            // 삭제된 게시물일 때 오류 
            // softDelete하면 자동으로 null 처리됨. 볼라면 withTrashed() 이거써야함
            if (!$result) {
                throw new Exception('삭제된 게시글입니다.');
            }

            // 이미지 가져오기
            $return = BoardImg::where('board_id', $this->boardId)->pluck('bi_img_path')->toArray();

            // 있으면 합치기
            $return ? array_unshift($return, $result) : $return = [$result];

            return response()->json(['message' => $return]);
            // return $result;
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
            // return response()->json(false);
        }
    }

    /**
     * 게시글 작성 틀
     * 
     * 요구멤버: $boardType, $safeData, $hasImageFile
     * 
     * 1. 게시글 생성
     * 2. 이미지 생성
     * 3. 썸네일 생성
     * 4. 저장
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store()
    {
        try {
            DB::beginTransaction();

            $post = $this->boardType->create($this->safeData); // 게시글 저장 로직 ...

            // 이미지 생성
            // 보드 작성 트랜잭션 안에 있으니 이미지 잘못 되어도 롤백 가능
            if ($this->hasImageFile) {
                // 이미지 생성 후 썸네일 설정 (중고는 최상위)
                // 최상위 이미지를 압축해서 public/images/thumbnails로
                $firstImgPath = ImageModule::saveImages($this->imageFile, $post, 0); // 중고 0, 제작 1, 문의 2

                // 편집 드라이버 호출
                $manager = new ImageManager(Driver::class);

                // 이미지 인스턴스
                $image = $manager->read(public_path($firstImgPath), FilePathImageDecoder::class);

                // 크기 조절
                $image->resize(height: 300);

                // 인스턴스 -> 이미지파일
                $encoded = $image->toJpg();

                // public/images/thumbnails 에따 저장
                $compressedImage = time() . $post->id . rand(000, 999) . '.jpg';
                $encoded->save(public_path('\\images\\thumbnails\\') . $compressedImage);

                // post->thumbnail 값 바꾸고 저장
                $post->ut_thumbnail = '\\images\\thumbnails\\' . $compressedImage;
                $post->save();
            }

            if (trim($post->ut_thumbnail) === '') {
                throw new Exception('썸네일 등록에 오류가 발생했습니다.');
            }

            DB::commit();

            return response()->json(["message" => "글이 작성되었습니다."]);
            // return response()->json(true);

        } catch (Exception $e) {
            DB::rollBack();
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
            // return response()->json(false);
        }
    }

    /**
     * 게시글 수정 틀
     * 
     * 요구멤버: $boardType, $boardId, $cookie, $safeData
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update()
    {
        try {
            // 삭제된거도 그냥 수정 가능
            $result = $this->boardType::withTrashed()->find($this->boardId);

            // 물론 본인만
            UserIdModule::check($this->cookie, $result->writer_id);

            // 수정 작업
            $result->update($this->safeData);

            return response()->json(['message' => '게시글이 수정되었습니다.']);
            // return response()->json(true);
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
            // return response()->json(false);
        }
    }

    /**
     * 게시글 삭제 틀
     * 
     * 요구멤버: $boardType, $deleteId
     * @return \Illuminate\Http\JsonResponse
     */
    protected function delete()
    {
        try {
            $result = $this->boardType::find($this->boardId);

            // 삭제된 게시물일 때 오류
            if (!$result) {
                throw new Exception('이미 삭제된 게시글입니다.');
            }

            // 작성자 다르면 오류
            UserIdModule::check($this->cookie, $result->writer_id);

            $result->delete();

            return response()->json(['message' => '게시글이 삭제되었습니다.']);
            // return response()->json(true);
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
            // return response()->json(false);
        }
    }

    /**
     * 삭제된 리스트 출력 틀
     * 
     * 요구멤버: $boardType, $boardPage
     * @return array|bool $lists = [$list]|[$list, $leftPages]
     */
    protected function index_deleted()
    {
        $list = [];

        // 음수값 오면 첫페이지로
        $this->boardPage < 1 ? $this->boardPage = 1 : '';

        foreach ($this->boardType as $key => $value) {
            // 뽑기 시작할 레코드 번수
            $offset = ($this->boardPage - 1) * $value[1];

            // 레코드 가져오기
            $list = $value[0]::onlyTrashed()
                ->orderByDesc('created_at')
                ->take($value[1])
                ->skip($offset)
                ->get();

            if (empty($list->count())) {
                return false;
            }

            // --- 페이지 묶음 출력 분기 ---
            // 전체 레코드
            $records = $value[0]::count();

            // 페이지 총 개수
            $pages = ceil($records / $value[1]);

            // 몇개만 출력?
            $leftPages = $pages % $this->boardPages;

            // 출력에 변동이 있는지 없는지 // 현재 페이지 >= 안맞아떨어지기 시작하는 페이지
            $nowPage = $offset / $value[1];
            $lists[] = $nowPage >= $pages - $leftPages ? ['list' => $list, 'leftPages' => $leftPages] : ['list' => $list];
        }

        return $lists;
    }

    /**
     * 삭제된 게시글 개별 출력 틀
     * 
     * 요구멤버: $boardType, $boardId, $cookie
     * @return \Illuminate\Http\JsonResponse
     */
    protected function view_deleted()
    {
        try {
            $result = $this->boardType::onlyTrashed()->find($this->boardId);

            // 작성자나 특정 유저만 열람
            UserIdModule::check($this->cookie, $result->writer_id);

            // 삭제안된 게시물일 때 오류
            if (!$result) {
                throw new Exception('삭제하지 않은 게시글입니다.');
            }

            return response()->json(['message' => $result]);
            // return $result;
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
            // return response()->json(false);
        }
    }
}
