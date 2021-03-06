INDX( 	                 (   �  �       �                    �     x b     �     �2��b� K�dJ�'��b��2��b�                        A r g u m e n t R e s o l v e r       �     � j     �     )��b� ��$0H��'��b� ��b�       �               A r g u m e n t R e s o l v e r . p h p       �     � |     �     10��b� ��$0H��G��b�,0��b�       �               A r g u m e n t R e s o l v e r I n t e r f a c e . p h p     �     � �     �     �R��b� ��$0H�Ih��b��R��b        j              " A r g u m e n t V a l u e R e s o l v e r I n t e r f a c e . p h p   �     � �     �     $r��b� ��$0H�V���b�r��b�       �
               C o n t a i n e r C o n t r o l l e r R e s o l v e r . p h p �     � p     �     W���b� ��$0H�$���b�P���b�       '               C o n t r o l l e r R e f e r e n c e . p h p �     � n     �     6���b� ��$0H�񽅔b�0���b� 0      �#               C o n t r o l l e r R e s o l v e r . p h p   �     � �    �     Qƅ�b� ��$0H��ׅ�b�Jƅ�b�       �               C o n t r o l l e r R e s o l v e r I n t e r f a c e . p h p �     � |     �     [���b� ��$0H�W�b�X���b�                      T r a c e a b l e A r g u m e n t R e s o l v e r . p h p     �     � �     �     ���b� ��$0H�]��b�
���b�       �               T r a c e a b l e C o n t r o l l e r R e s o l v e r . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?xml version="1.0" encoding="UTF-8" ?>

<xsd:schema xmlns="http://symfony.com/schema/routing"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    targetNamespace="http://symfony.com/schema/routing"
    elementFormDefault="qualified">

  <xsd:annotation>
    <xsd:documentation><![CDATA[
      Symfony XML Routing Schema, version 1.0
      Authors: Fabien Potencier, Tobias Schultze

      This scheme defines the elements and attributes that can be used to define
      routes. A route maps an HTTP request to a set of configuration variables.
    ]]></xsd:documentation>
  </xsd:annotation>

  <xsd:element name="routes" type="routes" />

  <xsd:complexType name="routes">
    <xsd:choice minOccurs="0" maxOccurs="unbounded">
      <xsd:element name="import" type="import" />
      <xsd:element name="route" type="route" />
    </xsd:choice>
  </xsd:complexType>

  <xsd:group name="configs">
    <xsd:choice>
      <xsd:element name="default" nillable="true" type="default" />
      <xsd:element name="requirement" type="element" />
      <xsd:element name="option" type="element" />
      <xsd:element name="condition" type="xsd:string" />
    </xsd:choice>
  </xsd:group>

  <xsd:complexType name="route">
    <xsd:group ref="configs" minOccurs="0" maxOccurs="unbounded" />

    <xsd:attribute name="id" type="xsd:string" use="required" />
    <xsd:attribute name="path" type="xsd:string" use="required" />
    <xsd:attribute name="host" type="xsd:string" />
    <xsd:attribute name="schemes" type="xsd:string" />
    <xsd:attribute name="methods" type="xsd:string" />
  </xsd:complexType>

  <xsd:complexType name="import">
    <xsd:group ref="configs" minOccurs="0" maxOccurs="unbounded" />

    <xsd:attribute name="resource" type="xsd:string" use="required" />
    <xsd:attribute name="type" type="xsd:string" />
    <xsd:attribute name="prefix" type="xsd:string" />
    <xsd:attribute name="host" type="xsd:string" />
    <xsd:attribute name="schemes" type="xsd:string" />
    <xsd:attribute name="methods" type="xsd:string" />
  </xsd:complexType>

  <xsd:complexType name="default" mixed="true">
    <xsd:choice minOccurs="0" maxOccurs="1">
      <xsd:element name="bool" type="xsd:boolean" />
      <xsd:element name="int" type="xsd:integer" />
      <xsd:element name="float" type="xsd:float" />
      <xsd:element name="string" type="xsd:string" />
      <xsd:element name="list" type="list" />
      <xsd:element name="map" type="map" />
    </xsd:choice>
    <xsd:attribute name="key" type="xsd:string" use="required" />
  </xsd:complexType>

  <xsd:complexType name="element">
    <xsd:simpleContent>
      <xsd:extension base="xsd:string">
        <xsd:attribute name="key" type="xsd:string" use="required" />
      </xsd:extension>
    </xsd:simpleContent>
  </xsd:complexType>

  <xsd:com