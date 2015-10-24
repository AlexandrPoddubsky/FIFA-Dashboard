CREATE TABLESPACE Admin_Data
  DATAFILE 'C:\app\Administrador\oradata\FIFADB\admindata01.dbf'
  SIZE 10M
  REUSE
  AUTOEXTEND ON
  NEXT 512k
  MAXSIze 200M;
  
  CREATE TABLESPACE Admin_Ind
   DATAFILE 'C:\app\Administrador\oradata\FIFADB\adminind01.dbf'
   SIZE 10M
   REUSE
   AUTOEXTEND ON
   NEXT 512k
   MAXSIZE 200M;
