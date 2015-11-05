create or replace package getCatalog is
-------------------------------------------------------------------------------

procedure Country (pCountryCatalog  out sys_refcursor);
procedure Continent (pcontinentcatalog out sys_refcursor);
procedure City (pCountryID in varchar2, pcityCatalog  out sys_refcursor);
procedure action (pActionCatalog  out sys_refcursor);
procedure event (pEventCatalog  out sys_refcursor);
procedure groupCatalog (pgroupCatalog  out sys_refcursor);
procedure lineUp (plineupCatalog  out sys_refcursor);
procedure stadium (pStadiumCatalog  out sys_refcursor);
procedure TDCatalog (pTDCatalog  out sys_refcursor);
procedure teamType (pTeamTypeCatalog  out sys_refcursor);
procedure TypePlayer (pTypePlayerCatalog  out sys_refcursor);

-------------------------------------------------------------------------------
END getCatalog;
