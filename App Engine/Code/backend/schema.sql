-- 	Copyright 2015, Google, Inc.
-- Licensed under the Apache License, Version 2.0 (the "License");
-- you may not use this file except in compliance with the License.
-- You may obtain a copy of the License at

--    http://www.apache.org/licenses/LICENSE-2.0

-- Unless required by applicable law or agreed to in writing, software
-- distributed under the License is distributed on an "AS IS" BASIS,
-- WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
-- See the License for the specific language governing permissions and
-- limitations under the License.

DROP DATABASE IF EXISTS phpworkshop;
CREATE DATABASE IF NOT EXISTS phpworkshop;
USE phpworkshop;

CREATE TABLE `phpworkshop`.`image` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(2083) NULL,
  `url` VARCHAR(2083) NULL,
  PRIMARY KEY (`id`));

GRANT ALL PRIVILEGES ON phpworkshop.* TO 'phpworkshop_user'@'localhost'
IDENTIFIED BY PASSWORD '*4187302F295DF9910AA3B202389A2DABC97C89B2';

GRANT ALL PRIVILEGES ON phpworkshop.* TO 'phpworkshop_user'@'%'
IDENTIFIED BY PASSWORD '*4187302F295DF9910AA3B202389A2DABC97C89B2';

