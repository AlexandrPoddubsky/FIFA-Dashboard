create or replace procedure winksIvegot (pUserNameId in number, pName out sys_refcursor) as
--using the parameter pUserNameId in the table person return un cursor with all person than has have winks I've ot
begin
  open pName for
         select p.firstname as fname, p.lastname1 as lname1, p.lastname2 as lname2
         from person p, winkperson wp
         where wp.winkedperson = pUserNameId
         and p.usernameid = wp.winker
         order by fname;
         Exception
         WHEN NO_DATA_FOUND THEN
              DBMS_OUTPUT.PUT_LINE ('Person not found:'); 
  
end;
