<?php

namespace App\Rules;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Captcha
{
    public bool $empty = false;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws GuzzleException
     * @throws JsonException
     */
    public function validate($attribute, $value): bool
    {
        $data = json_decode((new Client())->post('https://hcaptcha.com/siteverify', [
            'form_params' => [
                'secret' => config('services.hcaptcha.secret'),
                'response' => $value,
            ],
        ])->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return $data['success'] === true;
    }

    public function message(): string
    {
        return __('validation.captcha');
    }
}
