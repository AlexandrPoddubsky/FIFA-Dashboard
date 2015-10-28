CREATE OR REPLACE PROCEDURE getId(pUserEmail IN varchar2, identification OUT number) as
       BEGIN
         SELECT userId
         INTO identification
         FROM useradmin u
         WHERE pUserEmail = u.useremail;
       END;
