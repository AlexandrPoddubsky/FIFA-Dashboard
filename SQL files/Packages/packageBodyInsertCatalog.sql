CREATE OR REPLACE PACKAGE BODY insertCatalog AS
-------------------------------------------------------------------------------

procedure continent ( pContinentName varchar2)
as
       BEGIN
         insert into continentCatalog (continentID,continentName)
         values(continentID_seq.NextVal,pContinentName);

        Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Continent error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------
procedure city (pCityName varchar2, pCountryID varchar2)
  --insert a tuple in the table CityCatalog
as
       BEGIN
         insert into cityCatalog (cityid,cityName,countryID)
         values(cityID_seq.Nextval,pCityName,pCountryID);

        Exception
         WHEN INVALID_NUMBER THEN
              DBMS_OUTPUT.PUT_LINE ('City error ');
         --WHEN OTHERS THEN
           --   DBMS_OUTPUT.PUT_LINE ('Unexpected error');
             -- RAISE;
         commit;

       END;

-------------------------------------------------------------------------------

 procedure country (pCountryID varchar2, pCountryName varchar2, pContinentID number)
  --insert a tuple in the table Country
as
       BEGIN
         insert into countryCatalog (countryID,countryName,continentid)
         values(pCountryID,pCountryName, pContinentID);

        Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Country error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;

-------------------------------------------------------------------------------


procedure lineUp (pGoalKeeper number, pDefender number, pMidfield number, pLineForward number) as
begin
      insert into lineUpCatalog (lineUpID, goalKeeper, defender, midfield, lineForward)
      values (lineUpID_seq.Nextval, pGoalKeeper,pDefender,pMidfield,pLineForward);
            
       Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Lineup  catalog error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------

procedure stadium (pStadiumName varchar2, pCapacity number, pPicture varchar2 ) as
begin
      insert into stadiumCatalog (stadiumID, stadiumName, capacity, picture)
      values (stadiumID_seq.Nextval, pStadiumName,pCapacity,pPicture);
            
       Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Stadium catalog error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------
       
-------------------------------------------------------------------------------

procedure typePlayer (pTypePlayerName varchar2) as
begin
      insert into typePlayerCatalog (playerTypeID, Playertypename )
      values (typePlayerID_seq.Nextval, pTypePlayerName);
            
       Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Type player catalog error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------

procedure action (pActionName varchar2) as
begin
      insert into actionCatalog (actionID, actionName )
      values (actionID_seq.Nextval, pActionName);
            
       Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Action catalog error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------

       
-------------------------------------------------------------------------------

procedure teamType (pTeamTypeName varchar2) as
begin
      insert into teamTypeCatalog (teamTypeID, teamTypeName )
      values (teamTypeID_seq.Nextval, pTeamTypeName);
            
       Exception
         WHEN VALUE_ERROR THEN
              DBMS_OUTPUT.PUT_LINE ('Team type catalog error ');
         WHEN OTHERS THEN
              DBMS_OUTPUT.PUT_LINE ('Unexpected error');
              RAISE;
         commit;

       END;
       
-------------------------------------------------------------------------------
   
END insertCatalog;
