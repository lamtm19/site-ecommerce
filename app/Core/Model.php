<?php

namespace Mini\Core;

class Model
{
    protected $id;
    protected $created_at;
    protected $updated_at;

    /**
     * Get la veleur de l'id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set la valeur de l'id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get la valeur deupdated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set la valeur de updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Get la valeur de created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set la valeur de created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
}