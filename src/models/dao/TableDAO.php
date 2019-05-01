<?php
class TableDAO extends BaseDAO{
  function __construct(){
     parent::__construct("`table`");
  }
  function getTablesByAreaId($areaId){
    return $this->getAllWhere('area_id='.$areaId);
  }
  function getTable($tableId){
    return $this->getOnceWhere('id='.$tableId);
  }
}
?>
