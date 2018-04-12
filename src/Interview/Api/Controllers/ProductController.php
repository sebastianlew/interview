<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

namespace Sebastianlew\Interview\Api\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Sebastianlew\Interview\Product\Model\Product;
use Sebastianlew\Interview\Product\Repository\ProductRepository;

class ProductController extends Controller
{

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var Request
     */
    protected $request;

    /**
     * ProductController constructor.
     *
     * @param ProductRepository $productRepository
     * @param Request $request
     */
    public function __construct(ProductRepository $productRepository, Request $request)
    {
        $this->productRepository = $productRepository;
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = $this->productRepository->all();
        return response()->json($products, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws ModelNotFoundException
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new ModelNotFoundException();
        }

        return response()->json($product, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $product = new Product();
        $product->name = $this->request->get('name');
        $product->amount = $this->request->get('amount');
        $this->productRepository->save($product);
        return response()->json($product, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws ModelNotFoundException
     */
    public function update($id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new ModelNotFoundException();
        }

        $product->name = $this->request->get('name');
        $product->amount = $this->request->get('amount');
        $this->productRepository->save($product);
        return response()->json($product, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws ModelNotFoundException
     */
    public function delete($id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new ModelNotFoundException();
        }

        $this->productRepository->delete($product);
        return response()->json([], 200);
    }
}