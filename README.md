# Nome do Projeto

Desafio Revvo

---

## Autor

**Thiago Lopes Teixeira**  

Desenvolvedor Full Stack com experiência em desenvolvimento de soluções web, automação de processos e integração com APIs.

- 💼 LinkedIn: https://www.linkedin.com/in/thiago-lopes-teixeira/
- 💻 GitHub: https://github.com/thiagolt90
- 📧 E-mail: thiagolt90@gmail.com

---

## Tecnologias Utilizadas

- PHP 8.x
- MySQL
- JavaScript
- HTML5
- CSS3

---

## DB

-- Criar DB
CREATE SCHEMA `desafio_revvo`;

-- Criar tabela de usuários
CREATE TABLE `desafio_revvo`.`users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

-- Criar tabela de cursos
CREATE TABLE `desafio_revvo`.`courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT 1,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=1;