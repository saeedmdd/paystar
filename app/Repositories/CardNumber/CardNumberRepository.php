<?php

namespace App\Repositories\CardNumber;

use App\Models\CardNumber;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CardNumberRepository extends BaseRepository
{
    public function __construct(CardNumber $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $cardNumber
     * @return Model|null
     */
    public function findOrCreate(string $cardNumber): ?Model
    {
        $columns = [
            "user_id" => auth()->id(),
            "number" => $cardNumber
        ];
        $card = $this->findByColumns($columns);
        if (is_null($card))
            $card = $this->create($columns);
        return $card;
    }
}
