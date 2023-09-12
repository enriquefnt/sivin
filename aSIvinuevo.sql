DROP TABLE IF EXISTS  nuevo_Registro ;
CREATE TABLE nuevo_Registro
AS
SELECT
 IdNiño AS  RegistroId ,
  ApeNom AS RegistroNomCompleto ,
  SUBSTRING_INDEX(ApeNom, ' ', 1) AS RegistroNombres,
  SUBSTRING(ApeNom, LENGTH(SUBSTRING_INDEX(ApeNom, ' ', 1)) + 2) AS RegistroApellidos,
  -- SUBSTRING_INDEX(SUBSTRING(ApeNom, LENGTH(SUBSTRING_INDEX(ApeNom, ' ', 1)) + 2), ' ', -1) AS RegistroApellidos,
  Dni AS  RegistroNroDocumento ,
  FechaNto AS   RegistroFchNac ,
  Etnia AS  EtniaId ,
  Sexo AS  SexoId ,
  Peso AS   RegistroPeso ,
  Semanas AS RegistroSemGestacion ,
  Talla AS   RegistroTalla  ,
  UsuId AS  RegistroUsuCarga  ,
  FechaCapta AS  RegistroFchBaja ,
  Aoresi AS  RegistroAoResidId
  FROM niños;
select * from nuevo_Registro