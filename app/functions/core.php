<?php
    
    function _download_wrap($file_name , $path)
    {
        $path = seal(urlencode($path));

        return _route('attachment:download' , null , [
            'filename' => $file_name,
            'path' => $path
        ]);
    }

    function _download_unwrap($path)
    {
        return urldecode(unseal($path));
    }

    function _errorWithPage( $params = [])
    {
        return die("YOU HAVE SOMERRORS");
    }

    function _requireAuth()
    {
        if( ! whoIs() ){
            Flash::set("You must have an account to access this page." , 'warning');
            return redirect( _route('sec:login') );
        }
    }

    function _route($routeParam , $parameterId = '' , $parameter = [])
    {
        $routeParam = explode(':' , $routeParam);

        $routeKey = '';
        $method  = '';

        if( count($routeParam) > 1) {
            list( $routeKey , $method) = $routeParam;
        }

        $parameterString = '';

        if( !empty($parameterId) )
        {
            if(is_array($parameterId))
            {
                $parameterString .= "?";

                $counter = 0;
                foreach($parameterId as $key => $row) 
                {
                    if( $counter > 0)
                        $parameterString .= "&";

                    $parameterString .= "{$key}={$row}";
                    $counter++;
                }
            }else{
                //parameter is id
                $parameterString = '/'.$parameterId.'?';
            }
        }

        if( is_array($parameter) && !empty($parameter))
        {
            if( empty($parameterString) )
                $parameterString .= '?';
            $counter = 0;
            foreach($parameter as $key => $row) 
            {
                if( $counter > 0)
                    $parameterString .='&';
                $parameterString .= "{$key}={$row}";
                $counter++;
            }
        }

        $routesDeclared = Route::fetchRoutes();

        $routesDeclaredKeys = array_keys($routesDeclared);


        if( !in_array($routeKey , $routesDeclaredKeys)  ){
            echo die("Route {$routeKey} doest not exists");
        }

        $calledRoute = $routesDeclared[$routeKey];

        $calledRouteKeys = array_keys($calledRoute);

        if( !in_array($method, $calledRouteKeys)){
            echo die("Route {$routeKey} doest not have {$method} method does not exist!");
        }
        
        return $calledRoute[$method].$parameterString;
    }
    

    function _projectActivity($projectId , $message , $href , $createdBy)
    {
        $systemModel = model('SystemMetaModel');

        $system = $systemModel->getInstance();
        
        return $system->store([
            'meta_id' => $projectId,
            'meta_key' => 'PROJECT_NOTIFICATION',
            'value'    => $message,
            'href'     => $href,
            'created_by' => $createdBy
        ]);
    }


    function _notify($recipients = [] , $parameters = [])
    {

        $db = Database::getInstance();

        $sql = "INSERT INTO notifications(title , sub_title , notification , href , 
        recipient_id , type) VALUES";

        $title = $parameters['title'] ?? '';
        $sub_title = $parameters['sub_title'] ?? '';
        $notification = str_escape($parameters['notification'] ?? '');
        $href = str_escape($parameters['href'] ?? '');
        $recipient_id = $parameters['recipient_id'] ?? '';
        $type = $parameters['type'] ?? '';

        foreach($recipients as $key => $userId)
        {
            if( $key > 0 )
                $sql .= " , ";

            $sql.= "('$title' , '$sub_title' , '$notification' , '$href' , '$userId' , '$type')";
        }

        $db->query($sql);
        
        return $db->execute();
    }