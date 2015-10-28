create or replace package insertCatalog is
-------------------------------------------------------------------------------

procedure continent ( pContinentName varchar2);
procedure city (pCityName varchar2, pCountryID varchar2);
procedure country (pCountryID varchar2, pCountryName varchar2, pContinentID number);
procedure event (pEventName varchar2);
procedure lineUp (pGoalKeeper number, pDefender number, pMidfield number, pLineForward number);
procedure stadium (pStadiumName varchar2, pCapacity number, pPicture varchar2 );
procedure TD (pTDFirstName varchar2, pTDLastName1 varchar2, pTDLastName2 varchar2, pTDNationality varchar2);


-------------------------------------------------------------------------------
END insertCatalog;