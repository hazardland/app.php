<?php

	namespace Facebook\Auth;

	class Model implements \Core\Auth\Model
	{
		public function getUser ($id)
		{
			$query = Database::get()->prepare("
				SELECT
				`id`,
				`login`,
				`password`
				FROM `users`
				WHERE `id`=:id
				");
			$query->bindParam(':id', self::getId());
			if ($query->execute())
			{
				if ($row = $query->fetch())
				{
					new \App\User($row);
				}
			}
		}
	}