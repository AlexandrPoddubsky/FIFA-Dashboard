create or replace package updates is

procedure flag (pTeamID number, pflagpath varchar2);

procedure logo (pTeamID number, pLogoPath varchar2);

procedure playerPicture (pPlayerID number, pPicture varchar2);

procedure stadiumPicture (pStadiumID number, pPicture varchar2);

procedure tdPicture (pTdID number, pPicture varchar2);

procedure teamtd (pteamid number, pTdID number);

procedure teamcaptain (pteamID number, pDNI number);

procedure team (pTeamID number, pTeamName varchar2, pteamtypeid number, ptdid number );

procedure player ( pDNI varchar2, pFirstName varchar2, pLastName1 varchar2, pLastName2 varchar2, pClubTShirt number, 
                   pClubCaptain number, pCountry varchar2, pSelectionTshirt number, pSelectionCaptian number);
                   
procedure eventPicture (peventID number, pPicture varchar2);                   

END updates;
