<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    //
    public $elements = array(
        array('id'=>1, 'parent_id'=>0, 'title'=>'1'),
        array('id'=>2, 'parent_id'=>1, 'title' =>'2'),
        array('id'=>3, 'parent_id'=>1, 'title' =>'3'),
        array('id'=>4, 'parent_id'=>2, 'title' =>'4'),
        array('id'=>5, 'parent_id'=>2, 'title' =>'5'),
        array('id'=>6, 'parent_id'=>5, 'title' =>'6'),
        array('id'=>7, 'parent_id'=>6, 'title' =>'7'),
        array('id'=>8, 'parent_id'=>6, 'title' =>'8'),
    );


   public function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as  $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function buildTreePartly(array $elements, $id, $parentId = 0) {
        $maxId = $this->getMaxId($this->elements);

        if($id > $maxId) {
            abort(404);
        }

        $branch = array();

        foreach ($elements as  $element) {

            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTreePartly($elements, $id, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }

            if($element['id'] == $id) {
                return $branch;
            }
        }

        return $branch;

    }

    public function getMaxId($array)
    {
        return max(array_column($array, 'id'));
    }

}
