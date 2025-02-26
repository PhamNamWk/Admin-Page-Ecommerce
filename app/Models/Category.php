<?php

namespace  App\Models;

use App\Models\Model;

class Category extends Model
{
    protected $tableName = 'category';
    public function paginate($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->where($queryBuilder->expr()->neq('name', ':name'))
            ->setParameter('name', 'no category')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('id', 'DESC');


        $data = $queryBuilder->fetchAllAssociative();
        $totalPage = ceil($this->count() / $limit); // Làm tròn lên

        return [
            'data'          => $data,
            'page'          => $page,
            'limit'         => $limit,
            'totalPage'     => $totalPage
        ];
    }
    public function search($keyWord, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->where("name LIKE :keyWord")
            ->where($queryBuilder->expr()->neq('name', ':name'))
            ->setParameter('name', 'no category')
            ->setParameter('keyWord', "%$keyWord%")
            ->orderBy('id', 'DESC')
            ->from($this->tableName)
            ->setFirstResult($offset)
            ->setMaxResults($limit);



        $data = $queryBuilder->fetchAllAssociative();
        $totalPage = ceil($this->count($keyWord) / $limit); // Làm tròn lên

        return [
            'data'          => $data,
            'page'          => $page,
            'limit'         => $limit,
            'totalPage'     => $totalPage
        ];
    }
    public function count($keyWord = '')
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        if ($keyWord != '') {
            $queryBuilder->select('COUNT(*) as total')->from($this->tableName)->where('name LIKE :keyWord')->setParameter('keyWord', "%$keyWord%")->orderBy('id', 'DESC');
        } else {
            $queryBuilder->select('COUNT(*) as total')->from($this->tableName);
        }


        return $queryBuilder->fetchOne();
    }
    public function getNoCategory()
    {
        try {
            $queryBuider = $this->connection->createQueryBuilder();
            $queryBuider->select('*')->from($this->tableName)->where("name = 'no category'");
            return $queryBuider->fetchAssociative();
        } catch (\Throwable $th) {
            echo 'ERROR: ' . $th->getMessage();
            return null;
        }
    }
    public function createNoCategory()
    {
        $noCategory = $this->getNoCategory();
        if ($noCategory != null) {

            return $noCategory;
        } else {
            $queryBuider = $this->connection->createQueryBuilder();
            $queryBuider->insert($this->tableName)->setValue('name', ':name')
                ->setValue('description', ':description')
                ->setValue('status', ':status')
                ->setParameter('name', 'no category')
                ->setParameter('description', 'no category')
                ->setParameter('status', 0);
            $queryBuider->executeStatement();
            return $this->getNoCategory();
        }
    }
    public function updateProductCategory($idProduct)
    {
        $noCategory = $this->createNoCategory();
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->update('product')->set('category_id', ':categoryId')->where('id=:id')->setParameters([
            'categoryId' => $noCategory['id'],
            'id' => $idProduct
        ]);
        $queryBuilder->executeStatement();
    }
}
