<?php
/**
 * ExtListView class file.
 *
 */

Yii::import('zii.widgets.CListView');

/**
 * Extended version of CListView to display $listHeader and $listFooter
 */
class ExtListView extends CListView
{

    public $listHeader='';

    public $listFooter='';

    public $groupColumnName='';  // Name of column to group data using the value's first letter
    
    public $groupColumnValue=''; // Value of group column (first letter if different of previous row)

    public $groupFlag=0;

    /**
     * Renders the data item list.
     */
    public function renderItems()
    {
            echo $this->listHeader;
            $data=$this->dataProvider->getData();
            if(count($data)>0)
            {
                    $owner=$this->getOwner();
                    $render=$owner instanceof CController ? 'renderPartial' : 'render';

                    // init column group settings
                    $lastGroupValue='';
                    $groupRows=false;
                    if(!empty($this->groupColumnName))
                    {
                        $groupColumnName=$this->groupColumnName;
                        $groupRows=true;
                    }

                    $pos = 0;
                    $npos = 0;
                    foreach($data as $i=>$item)
                    {
                            $data=$this->viewData;
                            $data['index']=$i;
                            $data['data']=$item;
                            $data['widget']=$this;

                            /*
                             * Check if current group column's value is the same as the previous
                             * and set initial for row's view accordingly
                             */
                            if($groupRows)
                            {
                                $tmp=strtoupper(substr($item->$groupColumnName,0,1));
                                if($tmp==$lastGroupValue)
                                {
                                    $data['groupColumnValue']='';
                                }
                                else 
                                {
                                    $data['groupColumnValue']=strtoupper(substr($item->$groupColumnName,0,1));
                                    $lastGroupValue=$data['groupColumnValue'];
                                }

                            }

                            $data['groupFlag'] = $pos;
                            $pos = 1;
                            $npos++;
                            $data['npos'] = $npos;
                            $owner->$render($this->itemView,$data);
                    }
            }

            // render empty text
            if(count($data)==0)
		echo $this->emptyText===null ? CHtml::tag('span', array('class'=>'empty'), Yii::t('app','messg_no_records_found')) : $this->emptyText;

            echo $this->listFooter;

    }
}
