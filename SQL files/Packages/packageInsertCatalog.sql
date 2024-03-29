create or replace package insertCatalog is
-------------------------------------------------------------------------------

procedure continent ( pContinentName varchar2);
procedure city (pCityName varchar2, pCountryID varchar2);
procedure country (pCountryID varchar2, pCountryName varchar2, pContinentID number);

procedure lineUp (pGoalKeeper number, pDefender number, pMidfield number, pLineForward number);
procedure stadium (pStadiumName varchar2, pCapacity number, pPicture varchar2 );
procedure typePlayer (pTypePlayerName varchar2);
procedure action (pActionName varchar2);

procedure teamType (pTeamTypeName varchar2); 


-------------------------------------------------------------------------------
END insertCatalog;
