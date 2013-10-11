<?php

/**
 * Stylesheet class definition
 * @package CMS
 * @license GPL
 */

/**
 * Generic stylesheet class. This can be used for any logged in stylesheet or stylesheet related function.
 *
 * @since		0.11
 * @package		CMS
 * @license	 GPL
 */
class Stylesheet
{
	/**
	 * ID
	 */
	var $id;

	/**
	 * Name
	 */
	var $name;

	/**
	 * Value
	 */
	var $value;

	/**
	 * CSS Media Type
	 */
	var $media_type;

    /**
     * CSS Media Type
     */
    var $media_query;

	/**
	 * Sets some initial values
	 */
	function Stylesheet()
	{
		$this->SetInitialValues();
	}

	/**
	 * Sets object to some sane initial values
	 *
	 * @access private
	 */
	function SetInitialValues()
	{
		$this->id = -1;
		$this->name = '';
		$this->value = '';
		$this->media_type = '';
        $this->media_query = '';
	}

	/**
	 * Gets the Stylesheet id.
	 *
	 * @return integer The id of the Stylesheet.
	 */
	function Id()
	{
		return $this->id;
	}

	/**
	 * Gets the Stylesheet name.
	 *
	 * @return string The name of the Stylesheet.
	 */
	function Name()
	{
		return $this->name;
	}

	/**
	 * Saves the Stylesheet to the database, creating a new record.
	 *
	 * @return mixed If successful, true.  If it fails, false.
	 */
	function Save()
	{
		$result = false;

		$styleops = cmsms()->GetStylesheetOperations();

		if ($this->id > -1)
		{
			$result = $styleops->UpdateStylesheet($this);
		}
		else
		{
			$newid = $styleops->InsertStylesheet($this);
			if ($newid > -1)
			{
				$this->id = $newid;
				$result = true;
			}

		}

		return $result;
	}

	/**
	 * Deletes the Stylesheet from the database.
	 *
	 * @return mixed If successful, true.  If it fails, false.
	 */
	function Delete()
	{
		$result = false;

		if ($this->id > -1)
		{
			$styleops = cmsms()->GetStylesheetOperations();
			$result = $styleops->DeleteStylesheetByID($this->id);
			if ($result)
			{
				$this->SetInitialValues();
			}
		}

		return $result;
	}
}

# vim:ts=4 sw=4 noet
?>