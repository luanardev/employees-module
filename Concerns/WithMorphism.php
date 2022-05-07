<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Morphism;

trait WithMorphism
{
    public function link(Model $model)
    {
        $morph = new Morphism;
        return $morph->link($this, $model);
    }

    public function inverselink(Model $model)
    {
        $morph = new Morphism;
        return $morph->link($model, $this);
    }

    public function unlink(Model $model)
    {
        $morph = new Morphism;
        return $morph->unlink($this, $model);
    }

    public function inverseUnlink(Model $model)
    {
        $morph = new Morphism;
        return $morph->unlink($model, $this);
    }
}
