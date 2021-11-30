<?php   
    
    function btnView( $route  , $text = 'Show', $attributes  = null)
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="btn btn-primary btn-sm" {$attributes}><i class='fa fa-eye'> </i> {$text} </a>
        EOF;
    }

    function btnEdit( $route  , $text = 'Edit', $attributes  = null )
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="btn btn-primary btn-sm" {$attributes}><i class='fa fa-edit'> </i> {$text}  </a>
        EOF;
    }

    function btnDelete( $route  , $text = 'Delete', $attributes  = null )
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="form-verify btn btn-danger btn-sm" {$attributes}><i class='fa fa-trash'> </i> {$text} </a>
        EOF;
    }

    function btnList( $route  , $text = 'List', $attributes  = null )
    {
        $attributes = keypair_to_str($attributes ?? []);
        return <<<EOF
            <a href="{$route}" class="btn btn-primary btn-sm" {$attributes}><i class='fa fa-list'> </i> {$text}  </a>
        EOF;
    }


    function anchor( $route , $type = 'edit' , $text = null , $color = null)
    {
        $icon = 'edit';
        $a_text = 'Edit';
        $a_color = 'primary';

        switch($type)
        {
            case 'delete':
                $icon = 'trash';
                $a_text = 'Delete';
            break;
            case 'edit':
                $icon = 'edit';
                $a_text = 'Edit';
            break;

            case 'view':
                $icon = 'eye';
                $a_text = 'Show';
            break;

            case 'create':
                $icon = 'plus';
                $a_text = 'Create';
            break;
        }

        if( !is_null($text) )
            $a_text = $text;

        if( !is_null($color) )
            $a_color = 'danger';

        return <<<EOF
            <a href="{$route}" class='text-{$a_color}'><i class='fa fa-{$icon}'> </i> {$a_text}  </a>
        EOF;
    }


    function divider()
    {
        print <<<EOF
            <div style='margin:30px 0px'>
            </div>
        EOF;
    }

    function wReturnLink( $route )
    {
        print <<<EOF
            <a href="{$route}">
                <i class="feather icon-corner-up-left"></i> Return
            </a>
        EOF;
    }

    function wWrapSpan($text)
    {
        $retVal = '';
        
        if(is_array($text))
        {
            foreach($text as $key => $t) 
            {
                if( $key > 3 )
                    $classHide = '';
                $retVal .= "<span class='badge badge-primary badge-classic'> {$t} </span>";
            }
        }else{
            $retVal = "<span class='badge badge-primary badge-classic'> {$text} </span>";
        }

        return $retVal;
    }

    

    function wDivider()
    {
        return <<<EOF
            <div style="margin-top:30px"> </div>
        EOF;
    }