<?php

namespace App\Models;

use Libs\Model;

class UserModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->setTable('users');
    }

    public function userWithUserCatalogue($request = null)
    {



        $tableJoin      = "user_catalogues";
        $select         = "$this->tablename.*,  $tableJoin.id AS catalogue_id, $tableJoin.code AS catalogue_code, $tableJoin.name AS catalogue_name, $tableJoin.description AS catalogue_description";
        $relationship   = "$this->tablename.user_catalogue_id  = $tableJoin.id ";

        $datas = $this->table($this->tablename)->select($select)->leftJoin($tableJoin, $relationship)->get();

        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                $result[] = [
                    'id'                    => $data->id,
                    'user_catalogue_id'     =>  $data->user_catalogue_id,
                    'fullname'              =>  $data->fullname,
                    'email'                 =>  $data->email,
                    'password'              =>  $data->password,
                    'birthday'              =>  $data->birthday,
                    'avatar'                =>  $data->avatar,
                    'phone'                 =>  $data->phone,
                    'description'           =>  $data->description,
                    'publish'               =>  $data->publish,
                    'created_at'            =>  $data->created_at,
                    'updated_at'            =>  $data->updated_at,
                    'user_catalogue'        => [
                        'id'                    => $data->catalogue_id,
                        'code'                  => $data->catalogue_code,
                        'name'                  => $data->catalogue_name,
                        'description'           => $data->catalogue_description,
                    ],
                ];
            }
            return $result;
        }
    }

    public function getUserInfo($email, $password)
    {
        $tableJoin      = "user_catalogues";
        $select         = "$this->tablename.*,  $tableJoin.id AS catalogue_id, $tableJoin.code AS catalogue_code, $tableJoin.name AS catalogue_name, $tableJoin.description AS catalogue_description";
        $relationship   = "$this->tablename.user_catalogue_id  = $tableJoin.id ";


        $data = $this->table($this->tablename)->select($select)->leftJoin($tableJoin, $relationship)->where('email', '=', $email)->where('password', '=', $password)->getOne();

        $result = [
            'id'                    => $data['id'],
            'user_catalogue_id'     =>  $data['user_catalogue_id'],
            'fullname'              =>  $data['fullname'],
            'email'                 =>  $data['email'],
            'password'              =>  $data['password'],
            'birthday'              =>  $data['birthday'],
            'avatar'                =>  $data['avatar'],
            'phone'                 =>  $data['phone'],
            'description'           =>  $data['description'],
            'publish'               =>  $data['publish'],
            'created_at'            =>  $data['created_at'],
            'updated_at'            =>  $data['updated_at'],
            'user_catalogue'        => [
                'id'                    => $data['catalogue_id'],
                'code'                  => $data['catalogue_code'],
                'name'                  => $data['catalogue_name'],
                'description'           => $data['catalogue_description'],
            ],
        ];
        return $result;
    }
}
