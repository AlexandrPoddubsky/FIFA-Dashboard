 ---Schema solo se puede conectar desde system-----

  CREATE USER ADMINF
  IDENTIFIED BY FIFA123
  DEFAULT TABLESPACE  ADMIN_Data
  QUOTA 10M ON ADMIN_Data
  TEMPORARY TABLESPACE temp
  QUOTA 5M ON system ;
  
  --------------------------------------------------
  
  CREATE ROLE ADMINF --no funciono
  
  IDENTIFIED BY FIFA123;
  
  -------------------Permisos------------------------
  
  GRANT CONNECT TO ADMINF;
  
  GRANT CREATE SESSION TO ADMINF;
  
  GRANT CREATE TABLE TO ADMINF;

  ------------para poder crear los indices-----------

  GRANT CREATE ANY INDEX TO  ADMINF;  
  
  -----para poder hacer insert en los tablespace-----
  
  GRANT UNLIMITED TABLESPACE TO ADMINF;
  
  GRANT CREATE VIEW TO ADMINF;
  
  GRANT CREATE ANY INDEX TO ADMINF;
  
  GRANT DROP PUBLIC SYNONYM TO ADMINF;
  
  GRANT UNLIMITED TABLESPACE TO ADMINF;
  
  GRANT CREATE PROCEDURE TO ADMINF;
  
  GRANT EXECUTE ON UTILS TO ADMINF; --no funciona
  
  GRANT DEBUG CONNECT SESSION TO ADMINF;
  
  GRANT CREATE sequence TO ADMINF;
  
  grant create trigger to ADMINF;
  

