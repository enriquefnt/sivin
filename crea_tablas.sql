CREATE DATABASE `sivinsalta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;




CREATE TABLE `Notificacion` (
  `NotificacionId` bigint NOT NULL AUTO_INCREMENT,
  `RegistroId` bigint NOT NULL,
  `NotificacionFchIns` datetime NOT NULL,
  `NotificacionEstaBIns` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `NotificacionEdad` smallint NOT NULL,
  `NotificacionFecha` date NOT NULL,
  `NotificacionLugAtenc` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `NotificacionFchInternac` date NOT NULL,
  `NotificacionDiagIDIntern` bigint DEFAULT NULL,
  `NotificacionFchAltaIntern` date NOT NULL,
  `NotificacionPeso` mediumint NOT NULL,
  `NotificacionZscorePeso` decimal(6,3) NOT NULL,
  `NotificacionTalla` decimal(4,1) NOT NULL,
  `NotificacionZscoreTalla` decimal(7,3) NOT NULL,
  `NotificacionIMC` decimal(5,2) NOT NULL,
  `NotificacionZscoreImc` decimal(7,3) NOT NULL,
  `NotificacionObsAntrop` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `NotificacionDesnutricion` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `NotificacionUsuNot` mediumint NOT NULL,
  `NotificacionFchBaja` datetime NOT NULL,
  `NotificacionUsuBaja` mediumint NOT NULL,
  `NotificacionSeClasId` smallint DEFAULT NULL,
  `NotificacionSeDxNuId` smallint DEFAULT NULL,
  `NotificacionSevClasId` smallint DEFAULT NULL,
  `NotificacionSevDxNuId` smallint DEFAULT NULL,
  `NotificacionSgClasId` smallint DEFAULT NULL,
  `NotificacionSgDxNuId` smallint DEFAULT NULL,
  `NotificacionDiagObserva` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Notificacionzpr` smallint NOT NULL,
  `Notificacionzpg` smallint NOT NULL,
  `Notificacionzpb` smallint NOT NULL,
  `Notificacionztr` smallint NOT NULL,
  `Notificacionztg` smallint NOT NULL,
  `Notificacionztb` smallint NOT NULL,
  `Notificacionzir` smallint NOT NULL,
  `Notificacionzig` smallint NOT NULL,
  `Notificacionzib` smallint NOT NULL,
  PRIMARY KEY (`NotificacionId`),
  KEY `INOTIFICACION1` (`RegistroId`),
  KEY `INOTIFICACION2` (`NotificacionDiagIDIntern`),
  KEY `INOTIFICACION7` (`NotificacionEstaBIns`),
  KEY `INOTIFICACION3` (`NotificacionSeClasId`),
  KEY `INOTIFICACION4` (`NotificacionSeDxNuId`),
  KEY `INOTIFICACION5` (`NotificacionSevClasId`),
  KEY `INOTIFICACION6` (`NotificacionSevDxNuId`),
  KEY `INOTIFICACION8` (`NotificacionSgClasId`),
  KEY `INOTIFICACION9` (`NotificacionSgDxNuId`),
  CONSTRAINT `INOTIFICACION1` FOREIGN KEY (`RegistroId`) REFERENCES `Registro` (`RegistroId`),
  CONSTRAINT `INOTIFICACION3` FOREIGN KEY (`NotificacionSeClasId`) REFERENCES `DxClasificacion` (`DxClasificacionId`),
  CONSTRAINT `INOTIFICACION4` FOREIGN KEY (`NotificacionSeDxNuId`) REFERENCES `DxNutricion` (`DxNutricionId`),
  CONSTRAINT `INOTIFICACION5` FOREIGN KEY (`NotificacionSevClasId`) REFERENCES `DxClasificacion` (`DxClasificacionId`),
  CONSTRAINT `INOTIFICACION6` FOREIGN KEY (`NotificacionSevDxNuId`) REFERENCES `DxNutricion` (`DxNutricionId`),
  CONSTRAINT `INOTIFICACION8` FOREIGN KEY (`NotificacionSgClasId`) REFERENCES `DxClasificacion` (`DxClasificacionId`),
  CONSTRAINT `INOTIFICACION9` FOREIGN KEY (`NotificacionSgDxNuId`) REFERENCES `DxNutricion` (`DxNutricionId`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=SET utf8mb3 COLLATE=utf8_general_ci;
-- ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
-- ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- SELECT * FROM sivinsalta.imcmayorbis;
-- 
CREATE TABLE `Registro` (
  `RegistroId` bigint NOT NULL AUTO_INCREMENT,
  `RegistroFchIns` datetime NOT NULL,
  `RegistroFecha` date NOT NULL,
  `MotivoCargaId` smallint NOT NULL,
  `RegistroNroDocumento` int NOT NULL,
  `RegistroApellidos` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RegistroNombres` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RegistroNomCompleto` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `SexoId` int NOT NULL,
  `RegistroFchNac` date NOT NULL,
  `RegistroEdad` smallint NOT NULL,
  `EtniaId` int NOT NULL,
  `RegistroSemGestacion` smallint NOT NULL,
  `RegistroPeso` mediumint NOT NULL,
  `RegistroTalla` decimal(4,1) NOT NULL,
  `RegistroAsisSocial` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RegistroAoResidId` smallint NOT NULL,
  `RegistroEstabId` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RegistroUsuCarga` smallint NOT NULL,
  `RegistroSector` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RegistroFchBaja` datetime NOT NULL,
  `RegistroUsuBaja` mediumint NOT NULL,
  `RegistroFchCierre` datetime NOT NULL,
  `RegistroMotcierre` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RegistroUsuCierre` mediumint DEFAULT NULL,
  `RegistroEstaCierre` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `RegistroDomicilio` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `RegistroLocalidad` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`RegistroId`),
  KEY `IREGISTRO1` (`MotivoCargaId`),
  KEY `IREGISTRO2` (`SexoId`),
  KEY `IREGISTRO3` (`EtniaId`),
  KEY `IREGISTRO4` (`RegistroAoResidId`),
  KEY `IREGISTRO5` (`RegistroEstabId`),
  KEY `IREGISTRO6` (`RegistroUsuCarga`),
  KEY `IREGISTRO7` (`RegistroEstaCierre`),
  CONSTRAINT `IREGISTRO1` FOREIGN KEY (`MotivoCargaId`) REFERENCES `MotivoCarga` (`MotivoCargaId`),
  CONSTRAINT `IREGISTRO6` FOREIGN KEY (`RegistroUsuCarga`) REFERENCES `SecUser` (`SecUserId`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=SET utf8mb3 COLLATE=utf8_general_ci;
-- ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
-- ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;







CREATE TABLE `SecUser` (
  `SecUserId` smallint NOT NULL AUTO_INCREMENT,
  `SecUserName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `SecUserPassword` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `SecUserNombreCompleto` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `SecUserFechaBaja` date NOT NULL,
  `SecUserKey` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `SecUserUsuBaja` mediumint DEFAULT NULL,
  PRIMARY KEY (`SecUserId`),
  UNIQUE KEY `USUARIOUNICO` (`SecUserName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SELECT * FROM sivinsalta.SecUser;

SELECT * FROM sivinsalta.SecUser;CREATE TABLE `SecRole` (
  `SecRoleId` smallint NOT NULL AUTO_INCREMENT,
  `SecRoleName` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `SecRoleDescription` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`SecRoleId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
