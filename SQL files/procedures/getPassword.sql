create or replace procedure getPassword(pUserEmail IN varchar2, pPassword out varchar2) as

       BEGIN
         SELECT u.usernamepassword INTO pPassword
         FROM UserAdmin u
         WHERE (pUserEmail = u.useremail);

         exception
           when no_data_found then
             pPassword:= ' ';
        END;
