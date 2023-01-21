<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository extends BaseRepository
{
    const  SUCCESSFUL = "SUCCESSFUL";
    const PENDING = "PENDING";
    const FAILED = "FAILED";
    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $refNumber
     * @param array|string $columns
     * @param array|string $relations
     * @param array|string $appends
     * @return Model|Builder
     */
    public function findByRefNumber(string $refNumber, array|string $columns = ["*"], array|string $relations = [], array|string $appends = []): Model|Builder
    {
        return $this->setBuilder($relations)->where("ref_number", $refNumber)->find($columns)->append($appends);
    }
}
