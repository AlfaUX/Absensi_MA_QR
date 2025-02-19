<?php

namespace App\Models;

class RombelModel extends BaseModel
{
    protected $builder;

    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('tb_rombel');
    }

    //input values
   public function inputValues()
   {
      return [
         'rombel' => inputPost('rombel'),
      ];
   }

   public function addRombel()
   {
      $data = $this->inputValues();
      return $this->builder->insert($data);
   }

   public function editRombel($id)
   {
      $rombel = $this->getRombel($id);
      if (!empty($rombel)) {
         $data = $this->inputValues();
         return $this->builder->where('id', $rombel->id)->update($data);
      }
      return false;
   }

    public function getDataRombel()
    {
        return $this->builder->orderBy('id')->get()->getResult('array');
    }

    public function getRombel($id)
    {
        return $this->builder->where('id', cleanNumber($id))->get()->getRow();
    }


    public function deleteRombel($id)
   {
       $rombel = $this->getRombel($id);
       if (!empty($rombel)) {
           return $this->builder->where('id', $rombel->id)->delete();
       }
       return false;
   }
}
