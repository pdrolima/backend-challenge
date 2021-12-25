<?php

namespace App\Validators;

class ArticlesValidator
{
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'url' => [
                'required',
                'string',
                'max:255'
            ],
            'imageUrl' => [
                'required',
                'string',
                'max:255'
            ],
            'newsSite' => [
                'required',
                'string',
                'max:255'
            ],
            'summary' => [
                'required',
                'string',
                'max:255'
            ],
            'featured' => [
                'required',
                'boolean'
            ],
            'publishedAt' => [
                'sometimes',
                'required',
                'date'
            ],
            'launches.id' => [
                'sometimes',
                'required',
                'uuid',
            ],
            'launches.provider' => [
                'sometimes',
                'required',
                'string',
                'max:255'
            ],
            'events.id' => [
                'sometimes',
                'required',
                'uuid',
            ],
            'events.provider' => [
                'sometimes',
                'required',
                'string',
                'max:255'
            ],
        ];
    }

    /**
     * @param array $data
     * @param \App\Models\Article $article
     * @return array
     */
    public function validate($data, $article)
    {
        return validator($data, $this->rules($article))->validate();
    }
}
