<?php

    class LeagueSkillBalancerModel extends Model
    {   
        private $_revamp_type;
        /**
         * INITIALLY NERF
         * cooldown_revamp = []
         * cost_revamp = []
         * range_revamp = []
         * effect_revamp = []
         */
        public function balanceSkills($skills = [] , $nerf_or_buff = 'NERF')
        {
            $this->_revamp_type = $nerf_or_buff;

            foreach($skills as $skillIndex => $skill )
            {
                $maxrank = intval($skill->maxrank);

                //done
                $cooldown = $skill->cooldown;
                //cost
                $cost = $skill->cost;
                //range
                $range = $skill->range;
                /**
                 * always skip index[0]
                 */
                $effect = $skill->effect[1];

                $skill->cooldown_revamp = $this->cooldownRevamp($cooldown , $maxrank , $nerf_or_buff);
                $skill->cost_revamp = $this->costRevamp($cost , $maxrank , $nerf_or_buff);

                $skill->effect_revamp = $this->effectRevamp($effect , $maxrank , $nerf_or_buff);
            }
            
            return $skills;
        }  

        public function effectRevamp($effect , $maxrank , $nerf_or_buff)
        {
            $retval = [];

            $data_deduct = mt_rand(10 , 36);
            $percentage = 0;

            $percentage = floatval("0.0{$data_deduct}");

            for($i = 0 ; $i < $maxrank ; $i++) 
            {
                $convert_revamp = $effect[$i] * $percentage;
                
                if( isEqual($nerf_or_buff , 'nerf') ){
                    array_push($retval , round( $effect[$i] -= $convert_revamp ,2));
                }else{
                    array_push($retval , round($effect[$i] += $convert_revamp,2));
                }
            }

            return $retval;
        }
        
        public function costRevamp($cost , $maxrank , $nerf_or_buff)
        {
            $retval = [];
            $data_deduct = mt_rand(2 , 4);

            for($i = 0 ; $i < $maxrank ; $i++) 
            {
                if( isEqual($nerf_or_buff , 'nerf') ){
                    array_push($retval , $cost[$i] += $data_deduct);
                }else{
                    array_push($retval , $cost[$i] -= $data_deduct);
                }
            }

            return $retval;
        }

        public function cooldownRevamp($cooldown , $maxrank , $nerf_or_buff)
        {
            $retval = [];
            
            $data_deduct = mt_rand(2 , 4);
            $percentage = 0;

            // if( $data_deduct < 9 ){
            //     $percentage = floatval("0.0{$data_deduct}");
            // }else{
            //     $percentage = intval(0.10);//10 percent
            // }

            for($i = 0 ; $i < $maxrank ; $i++) 
            {
                // $convert_revamp = $cooldown[$i] * $percentage;

                if( isEqual($nerf_or_buff , 'nerf') ){
                    array_push($retval , $cooldown[$i] += $data_deduct);
                }else{
                    array_push($retval , $cooldown[$i] -= $data_deduct);
                }
            }

            return $retval;
        }
        /**
         * ATTRIBUTE 
         * cooldown , cost, range , effect
         */
        // public function revamp($valueSet = [] , $maxrank,  $attribute)
        // {
        //     $revamp_type = $this->_revamp_type;

        //     for($i = 0 ; $i <= $maxrank ; $i++) 
        //     {
        //         switch($attribute)
        //         {
        //             case 'effect':
        //                 if( $i == 0)
        //                     continue;//skip effect index0
        //                     if( isEqual($revamp_type , 'NERF') ){

        //                     }
        //             break;
        //         }
        //     }
        // }

        public function nerf()
        {

        }

        public function buff()
        {

        }
    }