<?php
interface IPlugin{
	/**	�������� �������
	*/
	public static function getName();
	/**	��� ������ ������ �� ����� , ������� ����� (public ��� public static)
	* 	������: array(link, href)  
	*	array getMenuItems(void)
	*/
	/**	��� ������ ������ �� ������, ������� ����� (public ��� public static)
	* 	������: array(�������� ������, href)
	* 	array getArticlesItems(void)
	*/
	/**	��� ������ ������ �� ����������, ������� ����� (public ��� public static)
	* 	������: array(�������� ����������, href)
	* 	array getAppsItems(void)
	*/
}
?>