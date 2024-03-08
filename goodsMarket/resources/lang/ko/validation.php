<?php

/**
 * The file downloaded from
 * https://github.com/caouecs/Laravel-lang/blob/master/ko/validation.php
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'after_or_equal'       => ':date 보다 빠르거나 같아야 합니다.',
    'before_or_equal'      => ':date 보다 늦거나 같아야 합니다.',

    'accepted' => '동의하지 않았습니다.',
    'active_url' => '값이 유효한 URL이 아닙니다.',
    'after' => '값이 :date 보다 이후 날짜가 아닙니다.',
    'alpha' => '값에 문자 외의 값이 포함되어 있습니다.',
    'alpha_dash' => '값에 문자, 숫자, 대쉬(-) 외의 값이 포함되어 있습니다.',
    'alpha_num' => '값에 문자와 숫자 외의 값이 포함되어 있습니다.',
    'array' => '값이 유효한 목록 형식이 아닙니다.',
    'before' => '값이 :date 보다 이전 날짜가 아닙니다.',
    'between' => [
        'numeric' => '값이 :min ~ :max 값을 벗어납니다.',
        'file' => '값이 :min ~ :max 킬로바이트를 벗어납니다.',
        'string' => '값이 :min ~ :max 글자가 아닙니다.',
        'array' => '값이 :min ~ :max 개를 벗어납니다.',
    ],
    'boolean' => '값이 true 또는 false 가 아닙니다.',
    'confirmed' => '와 확인 값이 서로 다릅니다.',
    'date' => '값이 유효한 날짜가 아닙니다.',
    'date_format' => '값이 :format 형식과 일치하지 않습니다.',
    'different' => '값이 :other은(는) 서로 다르지 않습니다.',
    'digits' => '값이 :digits 자릿수가 아닙니다.',
    'digits_between' => '값이 :min ~ :max 자릿수를 벗어납니다.',
    'distinct' => '값에 중복된 항목이 있습니다.',
    'email' => '값이 형식에 맞지 않습니다.',
    'exists' => '값에 해당하는 리소스가 존재하지 않습니다.',
    'filled' => '값은 필수 항목입니다.',
    'image' => '값이 이미지가 아닙니다.',
    'in' => '값이 유효하지 않습니다.',
    'in_array' => '값이 :other 필드의 요소가 아닙니다.',
    'integer' => '값이 정수가 아닙니다.',
    'ip' => '값이 유효한 IP 주소가 아닙니다.',
    'json' => '값이 유효한 JSON 문자열이 아닙니다.',
    'max' => [
        'numeric' => '값이 :max 보다 큽니다.',
        'file' => '값이 :max 킬로바이트보다 큽니다.',
        'string' => '값이 :max 글자보다 많습니다.',
        'array' => '값이 :max 개보다 많습니다.',
    ],
    'mimes' => '값이 :values 와(과) 다른 형식입니다.',
    'min' => [
        'numeric' => '값이 :min 보다 작습니다.',
        'file' => '값이 :min 킬로바이트보다 작습니다.',
        'string' => '값이 :min 글자 이상으로 작성하셔야합니다.',
        'array' => '값이 :max 개보다 적습니다.',
    ],
    'not_in' => '값이 유효하지 않습니다.',
    'numeric' => '값이 숫자가 아닙니다.',
    'present' => '필드가 누락되었습니다.',
    'regex' => '값의 형식이 유효하지 않습니다.',
    'required' => '항목은 필수 항목입니다.',
    'required_if' => '값이 누락되었습니다 (:other 값이 :value 일 때는 필수).',
    'required_unless' => '값이 누락되었습니다 (:other 값이 :value 이(가) 아닐 때는 필수).',
    'required_with' => '값이 누락되었습니다 (:values 값이 있을 때는 필수).',
    'required_with_all' => '값이 누락되었습니다 (:values 값이 있을 때는 필수).',
    'required_without' => '값이 누락되었습니다 (:values 값이 없을 때는 필수).',
    'required_without_all' => '값이 누락되었습니다 (:values 값이 없을 때는 필수).',
    'same' => '값이 :other 와 서로 다릅니다.',
    'size' => [
        'numeric' => '값이 :size 가 아닙니다.',
        'file' => '값이 :size 킬로바이트가 아닙니다.',
        'string' => '값이 :size 글자가 아닙니다.',
        'array' => '값이 :max 개가 아닙니다.',
    ],
    'string' => '값이 글자가 아닙니다.',
    'timezone' => '값이 올바른 시간대가 아닙니다.',
    'unique' => '값은 이미 사용 중입니다.',
    'url' => '값이 유효한 URL이 아닙니다.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'title' => '제목',
        'content' => '본문',
        'tags' => '태그',
        'files' => '파일',
        'files.*' => '파일',
        'name' => '이름',
        'email' => '이메일',
        'password' => '비밀번호',
        'password_confirmation' => '비밀번호 확인',
        'code'=> '제품 ID',
        'price'=> '가격',
        'context'=> '상세설명',
//        'use'=> '제품용도',
//        'size'=> '제품규격',
    ],
];