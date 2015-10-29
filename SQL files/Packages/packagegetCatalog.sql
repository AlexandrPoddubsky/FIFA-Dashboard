create or replace package getCatalog is
-------------------------------------------------------------------------------

procedure Country (pCountryCatalog  out sys_refcursor);
procedure City (pCountryID in varchar2, pcityCatalog  out sys_refcursor);


-------------------------------------------------------------------------------
END getCatalog;
