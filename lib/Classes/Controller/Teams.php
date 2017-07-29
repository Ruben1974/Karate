<?php

namespace Controller;
use \Database\DB;
use \PDO;

class Teams extends DB{
    /**
     * On class init connect to database
     * 
     */
    public function __construct(){
        parent::__construct(__DB_HOST__, __DB_USERNAME__, __DB_PASSWORD__, __DB_NAME__);
    }

    public function doExists($teamName){
        if(isset($teamName) && !empty($teamName)){
            $queryTeamName = $this->prepQuery("SELECT teamId FROM teams WHERE teamName = :NAME");
            $queryTeamName->bindParam(':NAME', $teamName, PDO::PARAM_STR);
            return $queryTeamName->execute() && ($queryTeamName->rowCount() === 0) ? false : true;
        }
        return false;
    }

    public function createTeam($teamData){
         if(isset($teamData) && !empty($teamData)){
            if(gettype($teamData) === 'array'){
                $queryCreateTeam = $this->prepQuery("INSERT INTO teams (teamName, fkStyle, fkAgeGrp, fkLevel, fkInstructor, teamPrice)VALUES(:NAME, :STYLE, :AGE, :LEVEL, :INSTRUCTOR, :PRICE)");
                return $queryCreateTeam->execute($teamData);
            }
         }
         return null;
    }

    public function getAllTeams(){
        $queryGetTeams = $this->prepQuery("SELECT teamId, teamName, teamPrice, stylesName, ageGrpName, levelName, firstname, lastname
                                            FROM teams
                                            INNER JOIN styles ON fkStyle = stylesId
                                            INNER JOIN agegroups ON fkAgeGrp = ageGrpId
                                            INNER JOIN levels ON fkLevel = levelId
                                            INNER JOIN instructors ON fkInstructor = insId
                                            INNER JOIN users ON fkUser = userId
                                            INNER JOIN userprofile ON fkProfile = profileId");
        if($queryGetTeams->execute()){
            return $queryGetTeams->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }

    public function getTeamById($teamId){
        if(isset($teamId) && !empty($teamId)){
            $queryGetTeam = $this->prepQuery("SELECT teamId, teamName, teamPrice, fkStyle, fkAgeGrp, fkLevel, fkInstructor,
                                            stylesName, ageGrpName, levelName, firstname, lastname
                                            FROM teams
                                            INNER JOIN styles ON fkStyle = stylesId
                                            INNER JOIN agegroups ON fkAgeGrp = ageGrpId
                                            INNER JOIN levels ON fkLevel = levelId
                                            INNER JOIN instructors ON fkInstructor = insId
                                            INNER JOIN users ON fkUser = userId
                                            INNER JOIN userprofile ON fkProfile = profileId
                                            WHERE teamId = :ID");
            $queryGetTeam->bindParam(':ID', $teamId, PDO::PARAM_INT);
            if($queryGetTeam->execute()){
                return $queryGetTeam->fetch(PDO::FETCH_OBJ);
            }
        }
        return null;
    }

    public function getTeamByStyleId($styleId){
         if(isset($styleId) && !empty($styleId)){
             $queryTeamByStyle = $this->prepQuery("SELECT teamId, teamName, teamPrice, stylesName, ageGrpName, levelName, firstname, lastname
                                            FROM teams
                                            INNER JOIN styles ON fkStyle = stylesId
                                            INNER JOIN agegroups ON fkAgeGrp = ageGrpId
                                            INNER JOIN levels ON fkLevel = levelId
                                            INNER JOIN instructors ON fkInstructor = insId
                                            INNER JOIN users ON fkUser = userId
                                            INNER JOIN userprofile ON fkProfile = profileId
                                            WHERE fkStyle = :ID");
            $queryTeamByStyle->bindParam(':ID', $styleId, PDO::PARAM_INT);
            if($queryTeamByStyle->execute()){
                return $queryTeamByStyle->fetchAll(PDO::FETCH_OBJ);
            }
         }
         return null;
    }

    public function updateTeam($teamData){
        if(isset($teamData) && !empty($teamData)){
            if(gettype($teamData) === 'array'){
                $queryUpdateTeam = $this->prepQuery("UPDATE teams SET teamNAme = :NAME,
                                                                      fkStyle = :STYLE, 
                                                                      fkAgeGrp = :AGE, 
                                                                      fkLevel = :LEVEL, 
                                                                      fkInstructor = :INSTRUCTOR, 
                                                                      teamPrice = :PRICE 
                                                    WHERE teamId = :ID");
                return $queryUpdateTeam->execute($teamData);
            }
        }
        return false;
    }

    public function deleteTeam($teamId){
        if(isset($teamId) && !empty($teamId)){
            $queryDeleteTeam = $this->prepQuery("DELETE FROM teams WHERE teamId = :ID");
            $queryDeleteTeam->bindParam(':ID', $teamId, PDO::PARAM_INT);
            return $queryDeleteTeam->execute();
        }
        return false;
    }
}