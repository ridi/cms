<?php

namespace Ridibooks\Platform\Cms\Auth;

use Ridibooks\Platform\Production\Constants\ProductAuthTag;

/**
 * 유저 Tag 관련 Class
 */
class AdminTagSessionOperator
{
	/**로그인 한 유저가 매니저인지 확인한다.
	 * @return bool
	 */
	public static function isManager()
	{
		return self::hasTagId(ProductAuthTag::MANAGER);
	}

	/**로그인 한 유저가 인턴인지 확인한다.
	 * @return bool
	 */
	public static function isInternship()
	{
		return self::hasTagId(ProductAuthTag::INTERNSHIP);
	}

	/**로그인 한 유저가 등록 아르바이트인지 확인한다.
	 * @return bool
	 */
	public static function isPartRegister()
	{
		return self::hasTagId(ProductAuthTag::PART_REGISTER);
	}

	/**로그인 한 유저가 제작 아르바이트인지 확인한다.
	 * @return bool
	 */
	public static function isPartMake()
	{
		return self::hasTagId(ProductAuthTag::PART_MAKE);
	}

	/**로그인 한 유저가 1차검수 아르바이트인지 확인한다.
	 * @return bool
	 */
	public static function isPart1stCheck()
	{
		return self::hasTagId([ProductAuthTag::PART_1ST_CHECK, ProductAuthTag::PART_1ST_CHECK_TEMP]);
	}

	/**로그인 한 유저가 2차검수 아르바이트인지 확인한다.
	 * @return bool
	 */
	public static function isPart2ndCheck()
	{
		return self::hasTagId(ProductAuthTag::PART_2ND_CHECK);
	}

	/**로그인 한 유저가 반장 아르바이트인지 확인한다.
	 * @return bool
	 */
	public static function isPartPrincipal()
	{
		return self::hasTagId(ProductAuthTag::PART_PRINCIPAL);
	}

	/**
	 * 로그인 한 유저가 작가 DB 아르바이트인지 확인한다.
	 * @return bool
	 */
	public static function isPartAuthorDb()
	{
		return self::hasTagId(ProductAuthTag::PART_AUTHOR);
	}

	/**
	 * 로그인 한 유저가 작가 DB 아르바이트가 아닌지 확인한다.
	 * @return bool
	 */
	public static function isNotPartAuthorDb()
	{
		return !self::isPartAuthorDb();
	}

	/**로그인 한 유저가 아르바이트인지 확인한다.
	 * @return bool
	 */
	public static function isParttimeJob()
	{
		$parttime_array = [
			ProductAuthTag::PART_PRINCIPAL,
			ProductAuthTag::PART_REGISTER,
			ProductAuthTag::PART_1ST_CHECK,
			ProductAuthTag::PART_1ST_CHECK_TEMP,
			ProductAuthTag::PART_2ND_CHECK,
			ProductAuthTag::PART_MAKE,
			ProductAuthTag::PART_AUTHOR
		];

		return self::hasTagId($parttime_array);
	}

	/**로그인 한 유저가 플랫폼팀인지 확인한다.
	 * @return bool
	 */
	public static function isDevCenter()
	{
		return self::hasTagId(AdminTagConstants::PLATFORMTEAM_TAG) || self::hasTagId(AdminTagConstants::VIEWERTEAM_TAG);
	}

	/**입력 받은 TagId 있는지 확인한다.
	 * @param mixed $tag_id
	 * @return bool
	 */
	public static function hasTagId($tag_id)
	{
		if (is_array($tag_id)) {
			return self::hasTagIdByArray($tag_id);
		} elseif (in_array($tag_id, $_SESSION['session_user_tagid'])) {
			return true;
		}

		return false;
	}

	/**입력 받은 TagId array 중 해당하는 ID가 있는지 확인한다.
	 * @param array $tag_id_array
	 * @return bool
	 */
	private static function hasTagIdByArray($tag_id_array)
	{
		return array_intersect($tag_id_array, $_SESSION['session_user_tagid']) ? true : false;
	}
}
