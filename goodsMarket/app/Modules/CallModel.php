<?php
namespace App\Modules;

use App\Models\Production;
use App\Models\UsedTrade;
use Illuminate\Support\Facades\DB;

class CallModel
{
    protected array|string|null $cookie;
    protected string $tableName;
    protected mixed $table;
    protected array $select;

    public function __construct($table, $cookie)
    {
        $this->table = $table;
        $this->select = ColumnForList::$forList[$table];
        $this->cookie = $cookie;
    }

    /**
     * 최근 본 게시물: 게시글 patch할 때 클라이언트에게 게시글 id남기게 하고 그걸로 가져와야겠다.
     * 
     * 요구멤버: $cookie
     * @param int $limit
     * @param int $offset
     */
    public function recent_view($limit, $offset = 0)
    {
        if($this->cookie){
            $boardIds = $this->cookie;
        } else {
            return [];
        }

        return DB::table($this->table)
            ->where(function ($q) use ($boardIds) {
                foreach ($boardIds as $value) {
                    $q->orWhere('id', $value);
                }
            })
            ->take($limit)
            ->skip($offset)
            ->select($this->select)
            ->get();
    }

    /**
     * 추천 게시물: 포괄점수제?, 뷰&좋아요 통계? 일단 랜덤으로 뽑고 추후에...
     * 
     * @param int $limit
     * @param int $offset
     */
    public function recommand($limit, $offset = 0)
    {
        $result = DB::table($this->table)
            ->orderByDesc($this->table . '.created_at')
            ->take($limit)
            ->skip(rand(1, DB::table($this->table)->count() - $limit))
            ->select($this->select)
            ->get();

        if($result->count() > 0){
            return $result->random(floor($limit / 2.5));
        } else {
            return $result;
        }
    }

    /**
     * 최근 등록된 게시물
     * 
     * @param int $limit
     * @param int $offset
     */
    public function recent($limit, $offset = 0)
    {
        return DB::table($this->table)
            ->orderByDesc($this->table . '.created_at')
            ->take($limit)
            ->skip($offset)
            ->select($this->select)
            ->when($this->table === 'used_trades', function ($q) {
                return $q->leftJoin('shipping_addresses as sa', 'sa.u_id', 'used_trades.id')
                    ->addSelect('sa.sa_address');
            })
            ->when($this->table === 'productions', function ($q) {
                return $q->leftJoin('users as u', 'u.id', 'productions.writer_id')
                    ->addSelect('u.u_nickname', 'u.u_profile_img');
            })
            ->get();
    }

    /**
     * 최근 거래 / 최근 리뷰 
     * 
     * @param int $limit
     * @param int $offset
     */
    public function sold_out($limit, $offset = 0)
    {
        $result = DB::table($this->table)
            ->when($this->table === 'used_trades', function($q) {
                return $q->where('ut_count', 0);
            })
            ->when($this->table === 'productions', function($q) {
                // return $q->rightJoin('리뷰', '리뷰.p_id', $this->table.'.id')
                // ->addSelect(리뷰.'.유저플필, .이름, .별점, .날짜, .내용'); // 리뷰뽑는거 따로해야하나
            })
            ->orderByDesc('created_at')
            ->take($limit)
            ->skip($offset)
            ->select($this->select)
            ->get();
            
        if($result->count() > 0){
            return $result->random(floor($limit / 2.5));
        } else {
            return $result;
        }
    }
}