<?php

namespace aliirfaan\CitronelCore\Traits;

trait CitronelMaskTrait
{
    /**
     * Method maskEmail
     *
     * @param int|string $contactDetail email to clean
     * @param string $maskCharacter mask character
     *
     * @return string
     */
    public function maskEmail($contactDetail, $maskCharacter = "*", $showFirstChars = 2, $showLastChars = 2)
    {
        list($username, $domain) = explode('@', $contactDetail);

        $usernameLength = strlen($username);
        $timesRepeat = abs(($usernameLength - $showFirstChars) - $showLastChars);
        $maskedUsername = substr($username, 0, $showFirstChars) . str_repeat($maskCharacter, $timesRepeat) . substr($username, - $showLastChars);
      
        return $maskedUsername . '@' . $domain;
    }
    
    /**
     * Method maskContactDetail
     *
     * @param $contactDetail $contactDetail [explicite description]
     * @param $contactDetailType $contactDetailType [explicite description]
     * @param $maskCharacter $maskCharacter [explicite description]
     *
     * @return string
     */
    public function maskContactDetail($contactDetail, $contactDetailType = 'mobile_phone', $maskCharacter = '*')
    {
        switch ($contactDetailType) {
            case 'mobile_phone':
                return $this->mobileNumberKit->maskMobileNumber($contactDetail, $maskCharacter);
                break;
            case 'email':
                return $this->maskEmail($contactDetail, $maskCharacter);
                break;
            default:
                return $this->maskDefault($contactDetail, $maskCharacter);
                break;
        }
    }

    /**
     * Masks valid MU mobile phone number using a mask character
     *
     * @param int|string $contactDetail Mobile number to clean
     * @param string $maskCharacter mask character
     *
     * @return string
     */
    public function maskMobileNumber($contactDetail, $maskCharacter = '*')
    {
        return $this->mobileNumberKit->maskMobileNumber($contactDetail, $maskCharacter);
    }
    
    /**
     * Method maskDefault
     *
     * @param string $detail [explicite description]
     * @param string $maskCharacter [explicite description]
     *
     * @return string
     */
    public function maskDefault($detail, $maskCharacter = '*')
    {
        return str_repeat($maskCharacter, strlen($detail));
    }
}
