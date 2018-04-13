<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

namespace Sebastianlew\Interview\Product\Repository;

use Sebastianlew\Interview\Core\BaseRepository;
use Sebastianlew\Interview\Product\Model\Product;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getInStock()
    {
        return $this->model->newQuery()
            ->where('amount', '>', 0)
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getOutOfStock()
    {
        return $this->model->newQuery()
            ->where('amount', 0)
            ->get();
    }

    /**
     * @param int $amount
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByQtyMoreThan($amount)
    {
        return $this->model->newQuery()
            ->where('amount', '>', $amount)
            ->get();
    }
}