SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

-- -----------------------------------------------------
-- Table `mydb`.`area`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`area` (
  `area_id` INT NOT NULL AUTO_INCREMENT ,
  `area_descripcion` VARCHAR(100) NULL ,
  `area_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`area_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`CIUDAD`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`CIUDAD` (
  `ciu_id` INT NOT NULL AUTO_INCREMENT ,
  `ciu_descripcion` VARCHAR(100) NULL ,
  `ciu_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`ciu_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`EMPRESA_REMITENTE`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`EMPRESA_REMITENTE` (
  `emprem_id` INT NOT NULL AUTO_INCREMENT ,
  `emprem_razonsocial` VARCHAR(150) NULL ,
  `emprem_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`emprem_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`ZONA`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ZONA` (
  `zon_id` INT NOT NULL AUTO_INCREMENT ,
  `zon_descripcion` VARCHAR(100) NULL ,
  `zon_precio` DECIMAL(10,2) NULL ,
  `zon_eliminado` CHAR(1) NULL ,
  `zon_precio_masivo` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`zon_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`TIPO_EDIFICACION`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`TIPO_EDIFICACION` (
  `tipedif_id` INT NOT NULL AUTO_INCREMENT ,
  `tipedif_descripcion` VARCHAR(150) NULL ,
  `tipedif_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`tipedif_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`TIPO_ENVIO_MASIVO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`TIPO_ENVIO_MASIVO` (
  `tipoenvm_id` INT NOT NULL AUTO_INCREMENT ,
  `tipoenvm_descripcion` VARCHAR(150) NULL ,
  `tipoenvm_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`tipoenvm_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`DEFICIENTES_MASIVOS`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`DEFICIENTES_MASIVOS` (
  `def_id` INT NOT NULL AUTO_INCREMENT ,
  `def_descripcion` VARCHAR(100) NULL ,
  `def_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`def_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`PLAZO_ENTREGA`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`PLAZO_ENTREGA` (
  `plaent_id` INT NOT NULL AUTO_INCREMENT ,
  `plaent_descripcion` VARCHAR(150) NULL ,
  `plaent_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`plaent_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`ZONA_ENVIO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ZONA_ENVIO` (
  `ze_id` INT NOT NULL AUTO_INCREMENT ,
  `ze_descripcion` VARCHAR(100) NULL ,
  `ze_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`ze_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`COSTO_ENVIO_MASIVO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`COSTO_ENVIO_MASIVO` (
  `ce_id` INT NOT NULL AUTO_INCREMENT ,
  `emprem_id` INT NOT NULL ,
  `ze_id` INT NOT NULL ,
  `ce_cantminima` INT(11) UNSIGNED NULL ,
  `ce_preciominima` DECIMAL(10,2) NULL ,
  `ce_preciomaxima` DECIMAL(10,2) NULL ,
  `ce_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`ce_id`) ,
  INDEX `COSTO_ENVIO_FKIndex2` (`ze_id` ASC) ,
  INDEX `COSTO_ENVIO_MASIVO_FKIndex2` (`emprem_id` ASC) ,
  CONSTRAINT `fk_{9A63461C-C75F-4B05-8B26-686A9D7AE2C3}`
    FOREIGN KEY (`ze_id` )
    REFERENCES `mydb`.`ZONA_ENVIO` (`ze_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{C9664D1E-F8C2-43FF-AAA3-1CD1C184B902}`
    FOREIGN KEY (`emprem_id` )
    REFERENCES `mydb`.`EMPRESA_REMITENTE` (`emprem_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`CARGOS_MASIVOS`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`CARGOS_MASIVOS` (
  `cmas_id` INT NOT NULL AUTO_INCREMENT ,
  `ce_id` INT NOT NULL ,
  `plaent_id` INT NOT NULL ,
  `def_id` INT NOT NULL ,
  `tipoenvm_id` INT NOT NULL ,
  `tipedif_id` INT NOT NULL ,
  `emprem_id` INT NOT NULL ,
  `area_id` INT NOT NULL ,
  `cmas_fecha` DATE NULL ,
  `cmas_destinatario` VARCHAR(150) NULL ,
  `cmas_direccion` VARCHAR(200) NULL ,
  `cmas_nombrerecibe` VARCHAR(200) NULL ,
  `cmas_parentescorecibe` VARCHAR(200) NULL ,
  `cmas_dnirecibe` VARCHAR(200) NULL ,
  `cmas_eliminado` CHAR(1) NULL ,
  `cmas_costoenvio` DECIMAL(10,2) NULL ,
  `cmas_incluyeigv` CHAR(1) NULL ,
  `cmas_colorfachada` VARCHAR(100) NULL ,
  `cmas_cantpisos` CHAR(2) NULL ,
  `cmas_telefono` VARCHAR(15) NULL ,
  `cmas_caserio` VARCHAR(200) NULL ,
  `cmas_costocaserio` DECIMAL(10,2) NULL ,
  `cmas_costocargo` DECIMAL(10,2) NULL ,
  `cmas_ciudad` VARCHAR(50) NULL ,
  PRIMARY KEY (`cmas_id`) ,
  INDEX `CARGOS_MENSAJERIA_FKIndex1` (`emprem_id` ASC) ,
  INDEX `CARGOS_MENSAJERIA_FKIndex2` (`area_id` ASC) ,
  INDEX `CARGOS_MASIVOS_FKIndex8` (`tipedif_id` ASC) ,
  INDEX `CARGOS_MASIVOS_FKIndex8` (`tipoenvm_id` ASC) ,
  INDEX `CARGOS_MASIVOS_FKIndex9` (`def_id` ASC) ,
  INDEX `CARGOS_MASIVOS_FKIndex7` (`plaent_id` ASC) ,
  INDEX `CARGOS_MASIVOS_FKIndex7` (`ce_id` ASC) ,
  CONSTRAINT `fk_{677855E1-18CC-499B-BC2C-51FE209EAE94}`
    FOREIGN KEY (`emprem_id` )
    REFERENCES `mydb`.`EMPRESA_REMITENTE` (`emprem_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{EF83500F-E68D-42A2-8BD5-60BAE785E18F}`
    FOREIGN KEY (`area_id` )
    REFERENCES `mydb`.`area` (`area_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{35C90CE4-6B47-4157-AB0C-71CB75D6FB65}`
    FOREIGN KEY (`tipedif_id` )
    REFERENCES `mydb`.`TIPO_EDIFICACION` (`tipedif_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{2EA67E5E-98A3-4810-9688-5E197681ADE0}`
    FOREIGN KEY (`tipoenvm_id` )
    REFERENCES `mydb`.`TIPO_ENVIO_MASIVO` (`tipoenvm_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{6C6F0037-D03B-4288-B739-0E3ACE805211}`
    FOREIGN KEY (`def_id` )
    REFERENCES `mydb`.`DEFICIENTES_MASIVOS` (`def_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{02D21584-DD16-4887-9853-CF183FC6EFFD}`
    FOREIGN KEY (`plaent_id` )
    REFERENCES `mydb`.`PLAZO_ENTREGA` (`plaent_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{E8A751FC-61D5-49F4-958F-F12B961A497D}`
    FOREIGN KEY (`ce_id` )
    REFERENCES `mydb`.`COSTO_ENVIO_MASIVO` (`ce_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`fragilidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`fragilidad` (
  `fra_id` INT NOT NULL AUTO_INCREMENT ,
  `fra_descripcion` VARCHAR(50) NULL ,
  `fra_precio` DECIMAL(10,2) NULL ,
  `fra_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`fra_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`embalaje`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`embalaje` (
  `emb_id` INT NOT NULL AUTO_INCREMENT ,
  `emb_descripcion` VARCHAR(50) NULL ,
  `emb_precio` DECIMAL(10,2) NULL ,
  `emb_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`emb_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_envio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tipo_envio` (
  `tipoenv_id` INT NOT NULL AUTO_INCREMENT ,
  `tipoenv_descripcion` VARCHAR(100) NULL ,
  `tipoenv_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`tipoenv_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_servicio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tipo_servicio` (
  `tiposerv_id` INT NOT NULL AUTO_INCREMENT ,
  `tiposerv_descripcion` VARCHAR(100) NULL ,
  `tiposerv_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`tiposerv_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`forma_pago`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`forma_pago` (
  `formpago_id` INT NOT NULL AUTO_INCREMENT ,
  `formpago_descripcion` VARCHAR(100) NULL ,
  `formpago_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`formpago_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`EMPRESA_COURIER`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`EMPRESA_COURIER` (
  `empcou_id` INT NOT NULL AUTO_INCREMENT ,
  `ciu_id` INT NOT NULL ,
  `empcou_razonsocial` VARCHAR(150) NULL ,
  `empcou_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`empcou_id`) ,
  INDEX `EMPRESA_COURIER_FKIndex1` (`ciu_id` ASC) ,
  CONSTRAINT `fk_{DC9ED09C-4E29-47CE-974C-963F4D52035E}`
    FOREIGN KEY (`ciu_id` )
    REFERENCES `mydb`.`CIUDAD` (`ciu_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`VOLUMEN`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`VOLUMEN` (
  `vol_id` INT NOT NULL AUTO_INCREMENT ,
  `vol_descripcion` VARCHAR(100) NULL ,
  `vol_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`vol_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`cargos_courier`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`cargos_courier` (
  `carcou_id` INT NOT NULL AUTO_INCREMENT ,
  `vol_excesivo` INT NOT NULL ,
  `empcou_id` INT NOT NULL ,
  `emprem_id` INT NOT NULL ,
  `ciu_id` INT NOT NULL ,
  `formpago_id` INT NOT NULL ,
  `tiposerv_id` INT NOT NULL ,
  `tipoenv_id` INT NOT NULL ,
  `area_id` INT NOT NULL ,
  `emb_id` INT NOT NULL ,
  `fra_id` INT NOT NULL ,
  `zon_id` INT NOT NULL ,
  `carcou_fecha` DATE NULL ,
  `carcou_consignadoa` VARCHAR(100) NULL ,
  `carcou_distrito` VARCHAR(100) NULL ,
  `carcou_direccion` VARCHAR(100) NULL ,
  `carcou_contacto` VARCHAR(100) NULL ,
  `carcou_autorizadopor` VARCHAR(100) NULL ,
  `carcou_peso` DECIMAL(10,2) NULL ,
  `carcou_recibidopor` VARCHAR(100) NULL ,
  `carcou_recepcionadopor` VARCHAR(100) NULL ,
  `carcou_fecharecepcion` DATE NULL ,
  `carcou_hora` VARCHAR(10) NULL ,
  `carcou_onservaciones` MEDIUMTEXT NULL ,
  `carcou_eliminado` CHAR(1) NULL ,
  `carcou_ciudadorigen` INT NULL ,
  `carcou_cantidad` INT NULL ,
  `carcou_costoservicio` DECIMAL(10,2) NULL ,
  `carcou_centrocosto` VARCHAR(50) NULL ,
  `carcou_costovolumen` DECIMAL(10,2) NULL ,
  `carcou_costoembalaje` DECIMAL(10,2) NULL ,
  `carcou_costofragilidad` DECIMAL(10,2) NULL ,
  `carcou_costoprimerkg` DECIMAL(10,2) NULL ,
  `carcou_costokgadicional` DECIMAL(10,2) NULL ,
  `carcou_igv` DECIMAL(10,2) NULL ,
  `carcou_subtotal` DECIMAL(10,2) NULL ,
  `carcou_total` DECIMAL(10,2) NULL ,
  `carcou_costokg` DECIMAL(10,2) NULL ,
  `vol_maximo` INT NULL ,
  `vol_simple` INT NULL ,
  `cant_vexcesivo` INT NULL ,
  `cant_vmaximo` INT NULL ,
  `cant_vsimple` INT NULL ,
  `costo_vexcesivo` DECIMAL(10,2) NULL ,
  `costo_vmaximo` DECIMAL(10,2) NULL ,
  `costo_vsimple` DECIMAL(10,2) NULL ,
  `cant_embalaje` INT NULL ,
  `cant_fragilidad` INT NULL ,
  `carcou_incluyeigv` CHAR(1) NULL ,
  PRIMARY KEY (`carcou_id`) ,
  INDEX `CARGOS_COURIER_FKIndex1` (`zon_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex2` (`fra_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex3` (`emb_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex4` (`area_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex5` (`tipoenv_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex6` (`tiposerv_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex7` (`formpago_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex8` (`ciu_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex9` (`emprem_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex10` (`empcou_id` ASC) ,
  INDEX `CARGOS_COURIER_FKIndex11` (`vol_excesivo` ASC) ,
  CONSTRAINT `fk_{CA9AC657-8B5D-4E84-B73F-6F49D0962226}`
    FOREIGN KEY (`zon_id` )
    REFERENCES `mydb`.`ZONA` (`zon_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{62A7694D-EE1D-4FA7-8621-F9F7CC9E101D}`
    FOREIGN KEY (`fra_id` )
    REFERENCES `mydb`.`fragilidad` (`fra_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{7D72DD45-167C-444C-BDC5-3426C1E35D63}`
    FOREIGN KEY (`emb_id` )
    REFERENCES `mydb`.`embalaje` (`emb_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{73C23C0D-2C9A-4069-999A-E3FBE842E8AA}`
    FOREIGN KEY (`area_id` )
    REFERENCES `mydb`.`area` (`area_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{BB17B041-DD43-468D-852B-4BC83D76B759}`
    FOREIGN KEY (`tipoenv_id` )
    REFERENCES `mydb`.`tipo_envio` (`tipoenv_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{7D2713FD-9717-4375-85CC-1E5502B97CDE}`
    FOREIGN KEY (`tiposerv_id` )
    REFERENCES `mydb`.`tipo_servicio` (`tiposerv_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{5368BDE7-F0F0-4183-A104-0CBA5AD9A6D6}`
    FOREIGN KEY (`formpago_id` )
    REFERENCES `mydb`.`forma_pago` (`formpago_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{91D830D4-EA0F-4F61-8473-2783E0B372AF}`
    FOREIGN KEY (`ciu_id` )
    REFERENCES `mydb`.`CIUDAD` (`ciu_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{BDC41258-9065-4676-BE0E-680EA60B1F10}`
    FOREIGN KEY (`emprem_id` )
    REFERENCES `mydb`.`EMPRESA_REMITENTE` (`emprem_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{BC5D7CF7-6C7E-4715-80A2-0F563BB07AA7}`
    FOREIGN KEY (`empcou_id` )
    REFERENCES `mydb`.`EMPRESA_COURIER` (`empcou_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{2DFD8914-EEA1-45AD-A286-0F78EABAAAC4}`
    FOREIGN KEY (`vol_excesivo` )
    REFERENCES `mydb`.`VOLUMEN` (`vol_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`CONTROL_REPORTES`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`CONTROL_REPORTES` (
  `rep_id` INT NOT NULL AUTO_INCREMENT ,
  `rep_manifiesto` INT NULL ,
  `rep_reportemensual` INT NULL ,
  `rep_resumen` INT NULL ,
  `rep_masivo_tec` INT NULL ,
  `rep_masivo_eco` INT NULL ,
  PRIMARY KEY (`rep_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`IGV`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`IGV` (
  `igv_id` INT NOT NULL AUTO_INCREMENT ,
  `igv_valor` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`igv_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`MANIFIESTO_DIARIO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`MANIFIESTO_DIARIO` (
  `man_id` INT NOT NULL AUTO_INCREMENT ,
  `empcou_id` INT NOT NULL ,
  `man_fechai` DATE NULL ,
  `man_fechaf` DATE NULL ,
  `man_nroreporte` INT NULL ,
  PRIMARY KEY (`man_id`) ,
  INDEX `MANIFIESTO_DIARIO_FKIndex1` (`empcou_id` ASC) ,
  CONSTRAINT `fk_{579E60CC-55BC-4679-9270-08B5F6FADCC1}`
    FOREIGN KEY (`empcou_id` )
    REFERENCES `mydb`.`EMPRESA_COURIER` (`empcou_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`REPORTE_MENSUAL`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`REPORTE_MENSUAL` (
  `rep_id` INT NOT NULL AUTO_INCREMENT ,
  `emprem_id` INT NOT NULL ,
  `rep_fechai` DATE NULL ,
  `rep_fechaf` DATE NULL ,
  `rep_nroreporte` INT NULL ,
  PRIMARY KEY (`rep_id`) ,
  INDEX `REPORTE_MENSUAL_FKIndex1` (`emprem_id` ASC) ,
  CONSTRAINT `fk_{F7046C18-499A-448F-8016-47A274CB0025}`
    FOREIGN KEY (`emprem_id` )
    REFERENCES `mydb`.`EMPRESA_REMITENTE` (`emprem_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`RESUMEN_CENTROCOSTO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`RESUMEN_CENTROCOSTO` (
  `res_id` INT NOT NULL AUTO_INCREMENT ,
  `emprem_id` INT NOT NULL ,
  `res_fechai` DATE NULL ,
  `res_fechaf` DATE NULL ,
  `res_nroresumen` INT NULL ,
  `res_centrocosto` VARCHAR(15) NULL ,
  PRIMARY KEY (`res_id`) ,
  INDEX `RESUMEN_CENTROCOSTO_FKIndex1` (`emprem_id` ASC) ,
  CONSTRAINT `fk_{059591C7-343A-4878-A0D5-47779A714998}`
    FOREIGN KEY (`emprem_id` )
    REFERENCES `mydb`.`EMPRESA_REMITENTE` (`emprem_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`roles` (
  `rol_id` INT NOT NULL AUTO_INCREMENT ,
  `rol_descripcion` VARCHAR(45) NULL ,
  PRIMARY KEY (`rol_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `usu_id` INT NOT NULL AUTO_INCREMENT ,
  `usu_nombres` VARCHAR(50) NULL ,
  `usu_apellidos` VARCHAR(50) NULL ,
  `usu_direccion` VARCHAR(80) NULL ,
  `usu_email` VARCHAR(50) NULL ,
  `usu_clave` VARCHAR(200) NULL ,
  `usu_eliminado` CHAR(1) NULL ,
  `usu_telefono` VARCHAR(20) NULL ,
  `usu_usuario` VARCHAR(45) NULL ,
  `roles_rol_id` INT NOT NULL ,
  PRIMARY KEY (`usu_id`) ,
  INDEX `fk_usuarios_roles1` (`roles_rol_id` ASC) ,
  CONSTRAINT `fk_usuarios_roles1`
    FOREIGN KEY (`roles_rol_id` )
    REFERENCES `mydb`.`roles` (`rol_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`UBIGEO2`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`UBIGEO2` (
  `ub_id` INT NOT NULL AUTO_INCREMENT ,
  `ub_id` INT NOT NULL ,
  `ub_descripcion` VARCHAR(150) NULL ,
  `ub_eliminado` CHAR(1) NULL ,
  `ub_tipo` CHAR(1) NULL ,
  PRIMARY KEY (`ub_id`) ,
  INDEX `UBIGEO_FKIndex1` (`ub_id` ASC) ,
  CONSTRAINT `fk_{77CA1DFA-3E7F-48A8-A270-8D3F867924D1}`
    FOREIGN KEY (`ub_id` )
    REFERENCES `mydb`.`UBIGEO2` (`ub_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`CIUDAD_ENVIO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`CIUDAD_ENVIO` (
  `cienv_id` INT NOT NULL AUTO_INCREMENT ,
  `cienv_descripcion` VARCHAR(150) NULL ,
  `cienv_eliminado` CHAR(1) NULL ,
  PRIMARY KEY (`cienv_id`) )
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`UBIGEO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`UBIGEO` (
  `CodDpto` INT(2) ZEROFILL NOT NULL ,
  `ze_id` INT NOT NULL ,
  `CodProv` INT(2) ZEROFILL NULL ,
  `CodDist` INT(2) ZEROFILL NULL ,
  `Nombre` INT(50) NULL ,
  PRIMARY KEY (`CodDpto`) ,
  INDEX `UBIGEO_FKIndex1` (`ze_id` ASC) ,
  CONSTRAINT `fk_{C71F76FE-385F-4FE1-9B91-DAA6C23A502F}`
    FOREIGN KEY (`ze_id` )
    REFERENCES `mydb`.`ZONA_ENVIO` (`ze_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_entidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tipo_entidad` (
  `tipe_id` INT NOT NULL AUTO_INCREMENT ,
  `tipe_descripcion` VARCHAR(50) NULL DEFAULT NULL ,
  PRIMARY KEY (`tipe_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_documento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tipo_documento` (
  `tipd_id` INT NOT NULL AUTO_INCREMENT ,
  `tipd_descripcion` VARCHAR(50) NULL DEFAULT NULL ,
  `tipd_codigo_sunat` VARCHAR(2) NULL DEFAULT NULL ,
  PRIMARY KEY (`tipd_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`entidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`entidad` (
  `ent_id` INT NOT NULL AUTO_INCREMENT ,
  `ent_razonsocial` VARCHAR(100) NULL DEFAULT NULL ,
  `ent_direccion` VARCHAR(100) NULL DEFAULT NULL ,
  `ent_nrodoc` CHAR(20) NULL DEFAULT NULL ,
  `ent_eliminado` CHAR(1) NULL DEFAULT NULL ,
  `ent_contacto` VARCHAR(50) NULL DEFAULT NULL ,
  `ent_telefono` VARCHAR(50) NULL DEFAULT NULL ,
  `ent_email` VARCHAR(100) NULL DEFAULT NULL ,
  `ent_nextel` VARCHAR(50) NULL DEFAULT NULL ,
  `ent_web` VARCHAR(150) NULL DEFAULT NULL ,
  `tipe_id` INT NOT NULL ,
  `tipd_id` INT NOT NULL ,
  PRIMARY KEY (`ent_id`) ,
  INDEX `fk_entidad_tipo_entidad1` (`tipe_id` ASC) ,
  INDEX `fk_entidad_tipo_documento1` (`tipd_id` ASC) ,
  CONSTRAINT `fk_entidad_tipo_entidad1`
    FOREIGN KEY (`tipe_id` )
    REFERENCES `mydb`.`tipo_entidad` (`tipe_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entidad_tipo_documento1`
    FOREIGN KEY (`tipd_id` )
    REFERENCES `mydb`.`tipo_documento` (`tipd_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_comprobantes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tipo_comprobantes` (
  `tipc_id` INT NOT NULL AUTO_INCREMENT ,
  `tipc_descripcion` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`tipc_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_operacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tipo_operacion` (
  `top_id` INT NOT NULL AUTO_INCREMENT ,
  `top_descripcion` VARCHAR(45) NULL DEFAULT NULL ,
  `top_codigo_sunat` CHAR(2) NULL DEFAULT NULL ,
  PRIMARY KEY (`top_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_moneda`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tipo_moneda` (
  `tipm_id` INT NOT NULL AUTO_INCREMENT ,
  `tipm_descripcion` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`tipm_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comprobantes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`comprobantes` (
  `com_id` INT NOT NULL AUTO_INCREMENT ,
  `ent_id` INT NOT NULL ,
  `com_fecha` DATE NULL DEFAULT NULL ,
  `com_estado` CHAR(1) NULL DEFAULT NULL ,
  `ped_id` INT NULL DEFAULT NULL ,
  `com_seriedoc` VARCHAR(20) NULL DEFAULT NULL ,
  `com_nrodoc` VARCHAR(20) NULL DEFAULT NULL ,
  `tipc_id` INT NOT NULL ,
  `are_id` INT NOT NULL ,
  `top_id` INT NOT NULL ,
  `com_igv` DECIMAL(10,2) NULL DEFAULT NULL ,
  `tipm_id` INT NOT NULL ,
  `usu_id` INT NOT NULL ,
  PRIMARY KEY (`com_id`) ,
  INDEX `ventas_FKIndex1` (`ent_id` ASC) ,
  INDEX `fk_ventas_tipo_comprobantes1` (`tipc_id` ASC) ,
  INDEX `fk_ventas_areas1` (`are_id` ASC) ,
  INDEX `fk_comprobantes_tipo_operacion1` (`top_id` ASC) ,
  INDEX `fk_comprobantes_tipo_moneda1` (`tipm_id` ASC) ,
  INDEX `fk_comprobantes_usuarios1` (`usu_id` ASC) ,
  CONSTRAINT `fk_{525B0F4B-2A91-4921-9C59-B8901E70335F}`
    FOREIGN KEY (`ent_id` )
    REFERENCES `mydb`.`entidad` (`ent_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_tipo_comprobantes1`
    FOREIGN KEY (`tipc_id` )
    REFERENCES `mydb`.`tipo_comprobantes` (`tipc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_areas1`
    FOREIGN KEY (`are_id` )
    REFERENCES `mydb`.`areas` (`are_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobantes_tipo_operacion1`
    FOREIGN KEY (`top_id` )
    REFERENCES `mydb`.`tipo_operacion` (`top_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobantes_tipo_moneda1`
    FOREIGN KEY (`tipm_id` )
    REFERENCES `mydb`.`tipo_moneda` (`tipm_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobantes_usuarios1`
    FOREIGN KEY (`usu_id` )
    REFERENCES `mydb`.`usuarios` (`usu_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`detalle_comprobante`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`detalle_comprobante` (
  `dcom_id` INT NOT NULL AUTO_INCREMENT ,
  `pro_id` INT NOT NULL ,
  `com_id` INT NOT NULL ,
  `dcom_cantidad` DECIMAL(10,2) NULL DEFAULT NULL ,
  `dcom_precio` DECIMAL(10,3) NULL DEFAULT NULL ,
  `dcom_importe` DECIMAL(10,3) NULL DEFAULT NULL ,
  `dcom_detalle_adicional` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`dcom_id`) ,
  INDEX `detalle_ventas_FKIndex1` (`com_id` ASC) ,
  INDEX `detalle_ventas_FKIndex2` (`pro_id` ASC) ,
  CONSTRAINT `fk_{97D74A58-A431-4A54-8BDC-BA7D895C72C7}`
    FOREIGN KEY (`com_id` )
    REFERENCES `mydb`.`comprobantes` (`com_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{8CC35DAB-EF17-4BFB-A0CD-C22DB62AD9EF}`
    FOREIGN KEY (`pro_id` )
    REFERENCES `mydb`.`productos` (`pro_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `mydb`.`permisos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`permisos` (
  `per_id` INT NOT NULL AUTO_INCREMENT ,
  `per_descripcion` VARCHAR(45) NULL ,
  PRIMARY KEY (`per_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`roles_permisos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`roles_permisos` (
  `rol_id` INT NOT NULL ,
  `per_id` INT NOT NULL ,
  PRIMARY KEY (`rol_id`, `per_id`) ,
  INDEX `fk_roles_has_permisos_roles1` (`rol_id` ASC) ,
  INDEX `fk_roles_has_permisos_permisos1` (`per_id` ASC) ,
  CONSTRAINT `fk_roles_has_permisos_roles1`
    FOREIGN KEY (`rol_id` )
    REFERENCES `mydb`.`roles` (`rol_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_permisos_permisos1`
    FOREIGN KEY (`per_id` )
    REFERENCES `mydb`.`permisos` (`per_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`ci_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ci_sessions` (
  `session_id` VARCHAR(40) NULL DEFAULT 0 ,
  `ip_address` VARCHAR(16) NULL DEFAULT 0 ,
  `user_agent` VARCHAR(50) NULL ,
  `last_activity` INT(10) UNSIGNED NULL DEFAULT 0 ,
  `user_data` TEXT NOT NULL )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
