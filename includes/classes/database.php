<?php

class Database {

    public $connection;
    public $query;
    public $num_queries = 0;
    public $result;
    public $lastid;
    public $affectedrows;

    // Constructor
    function __construct()
    {
    }

    //------------------------------------------------------//
    public function connect( $db_host, $db_user, $db_pass, $db_name )
        //------------------------------------------------------//
    {
        $this->db_host	= $db_host;
        $this->db_user	= $db_user;
        $this->db_pass 	= $db_pass;
        $this->db_name 	= $db_name;

        $this->connection = @mysqli_connect( $this->db_host, $this->db_user, $this->db_pass, $this->db_name ) or die( 'DB CONNECT ERROR: (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() );

        if ( $this->connection )
        {
            return $this->connection;
        }
        else
        {
            return false;
        }
    }

    //------------------------------------------------------//
    public function close()
        //------------------------------------------------------//
    {
        if ( $this->connection )
        {
            if ( $this->query )
            {
                @mysqli_free_result()( $this->query );
            }
            $result = @mysqli_close($this->connection);
            return $result;
        }
        else
        {
            return false;
        }
    }

    //------------------------------------------------------//
    public function query( $query )
        //------------------------------------------------------//
    {
        unset( $this->result );

        if ($query != '')
        {
            $this->result = @mysqli_query( $this->connection, $query )
            or $this->error( $query, '(' . mysqli_errno( $this->connection ) . ') ' . mysqli_error( $this->connection ), __LINE__);
            $this->lastid = mysqli_insert_id( $this->connection );
            $this->affectedrows = mysqli_affected_rows( $this->connection );
            $this->num_queries++;
        }

        if ($this->result)
        {
            return $this->result;
        }
        else
        {
            return false;
        }
    }

    //------------------------------------------------------//
    public function error( $query, $error, $line )
        //------------------------------------------------------//
    {
        if ( DEBUG_MODE == true )
        {
            echo "Query: $query<br>";
            echo "Error: " . $error . '<br>';
            echo "Line: $line<br>";
        }
    }

    //------------------------------------------------------//
    public function numrows($stream)
        //------------------------------------------------------//
    {
        if ($stream) {
            $result = @mysqli_num_rows($stream);
            return $result;
        } else {
            return false;
        }
    }

    //------------------------------------------------------//
    public function getLastID()
        //------------------------------------------------------//
    {
        return $this->lastid;
    }

    //------------------------------------------------------//
    public function getAffectedRows()
        //------------------------------------------------------//
    {
        return $this->affectedrows;
    }


    //------------------------------------------------------//
    public function makeSafe($string)
        //------------------------------------------------------//
    {
        $string	= addslashes( trim( $string ) );
        return $string;
    }

    //------------------------------------------------------//
    public function fetcharray($stream = '')
        //------------------------------------------------------//
    {
        if (!$stream) {
            $stream = $this->result;
        }

        if($stream) {
            $this->query_id = @mysqli_fetch_assoc($stream);
            return $this->query_id;
        } else {
            return false;
        }
    }

    //------------------------------------------------------//
    public function fetchrow($stream = '')
        //------------------------------------------------------//
    {
        if ($stream) {
            $result = @mysqli_fetch_row($stream);
            return $result;
        } else {
            return false;
        }
    }

    //------------------------------------------------------//
    public function freeresult( $query_id )
        //------------------------------------------------------//
    {
        if ( $query_id )
        {
            unset( $this->array[$query_id] );

            @mysqli_free_result( $query_id );

            return true;
        }
        else
        {
            return false;
        }
    }

}

?>