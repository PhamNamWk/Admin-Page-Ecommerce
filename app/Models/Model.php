<?php

namespace App\Models;

use Doctrine\DBAL\DriverManager;

class Model
{
    protected $connection;
    protected $tableName;
    public function __construct()
    {
        $connectionParams = [

            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER'],

        ];
        $this->connection = DriverManager::getConnection($connectionParams);
    }
    public function __destruct()
    {
        $this->connection->close();
    }
    public function paginate($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
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

    public function findAll()
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')->from($this->tableName)->orderBy('id', 'DESC');
        return $queryBuilder->fetchAllAssociative();
    }
    public function find($id)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('*')->from($this->tableName)
            ->where('id = :id')
            ->setParameter('id', $id);
        return $queryBuilder->fetchAssociative();
    }
    public function insert(array $data) // ex: data=['email'=>email]
    {
        $this->connection->insert($this->tableName, $data);
    }
    public function delete($id)
    {
        $this->connection->delete($this->tableName, ['id' => $id]);
    }
    public function update($id, array $data)
    {
        $this->connection->update($this->tableName, $data, ['id' => $id]);
    }
}
