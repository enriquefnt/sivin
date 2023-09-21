Select NotId AS IdNoti, DATE_FORMAT(NotFecha , "%d/%m/%Y") AS Fecha,  IdNiño,
  ROUND(NotPeso,2) AS Peso, 
    NotTalla AS Talla, ROUND(NotZpe,2) AS ZPesoEdad ,ROUND(NotZta,2)  AS ZTallaEdad ,
 	ROUND(NotZimc,2) AS ZIMCEdad , MotNom, SevoNom, SclinNom,@tabla:="Notificación" AS Tipo, 
    if(NotFin="SI","Alta","Activo") AS Estado, NotFecha AS Ordena, 
    if(NotMatricula="SIN DATO","NO","SI") AS Medico, Aoresi,NotFin,IdCtrol,NotFin, TIMESTAMPDIFF(DAY, NotFecha, now()) AS dias_transcurridos,
    DATEDIFF( NotFechaSist, NotFecha) as retraso,  CONCAT(Ape,", ",Nom) AS vigilante

from NOTIFICACION 
left join NIÑOS on NotNiño=IdNiño
left join SEGUNEVOLUCION on NotEvo = SevoId
left join SEGUNCLINICA on NotClinica = SclinId
left join MOTIVOSNOTI on NotMotivo = MotId
left join AREAS on Aoresi=Ao_Id
left join NIÑORESIDENCIA on IdNiño =ResiNiño
left join NOTICONTROL on NotId=IdNoti
inner join ESTABLECIMIENTOS on NotEfec =Est_Id
inner join USUARIOS on NotUsuario = Idusuario
where  IdCtrol IS null AND Aoresi = 12
-- Aoresi= aope AND NotFin="NO" AND IdCtrol
UNION
select t.IdNoti, DATE_FORMAT(t.CtrolFecha , "%d/%m/%Y") AS Fecha, IdNiño,

  ROUND(t.CtrolPeso,2) AS Peso,
	CtrolTalla AS Talla, ROUND(t.CtrolZp,2) AS ZPesoEdad ,ROUND(t.CtrolZt,2)  AS ZTallaEdad , 
    ROUND(t.CtrolZimc,2) AS ZIMCEdad , MotNom, SevoNom, SclinNom,
	@tabla:="Control" AS Tipo,if(NotFin="SI","Alta","Activo") AS Estado, @ordena:=CtrolFecha,
	if(CtrolMatricula="SIN DATO","NO","SI") AS Medico,Aoresi,NotFin,IdCtrol,NotFin, TIMESTAMPDIFF(DAY, CtrolFecha, now()) AS dias_transcurridos,
	DATEDIFF(CtrolFechapc,CtrolFecha) AS retraso ,  CONCAT(Ape,", ",Nom)  AS vigilante

				from NOTICONTROL t
                inner join NOTIFICACION on IdNoti=NotId
				inner join NIÑOS on NotNiño=IdNiño
                --  inner join (select IdNoti, max(CtrolFecha) as MaxdateCtrl
				--  from NOTICONTROL
				 -- group by IdNoti)
                --  tm on t.IdNoti= tm.IdNoti and t.CtrolFecha = tm.MaxDateCtrl           
				inner join SEGUNEVOLUCION on NotEvo = SevoId
				inner join SEGUNCLINICA on NotClinica = SclinId
				inner join MOTIVOSNOTI on NotMotivo = MotId
				inner join AREAS on Aoresi=Ao_Id
				inner join NIÑORESIDENCIA on IdNiño =ResiNiño
                inner join ESTABLECIMIENTOS on CtrolEfec =Est_Id
				inner join USUARIOS on CtrolUsuario = Idusuario
								 where Aoresi= 12 -- AND NotFin="NO" 
                               -- GROUP BY Nombre
                                order by Ordena desc;