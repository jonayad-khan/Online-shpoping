f:AttrType_alttranstype" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_at_segsrc_mid">
      <xsd:selector xpath="./xlf:seg-source/xlf:mrk"/>
      <xsd:field xpath="@mid"/>
    </xsd:unique>
    <xsd:keyref name="KR_at_segsrc_mid" refer="xlf:U_at_segsrc_mid">
      <xsd:selector xpath="./xlf:target/xlf:mrk"/>
      <xsd:field xpath="@mid"/>
    </xsd:keyref>
  </xsd:element>
  <xsd:element name="bin-unit">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:element ref="xlf:bin-source"/>
        <xsd:element minOccurs="0" ref="xlf:bin-target"/>
        <xsd:choice maxOccurs="unbounded" minOccurs="0">
          <xsd:element ref="xlf:context-group"/>
          <xsd:element ref="xlf:count-group"/>
          <xsd:element ref="xlf:note"/>
          <xsd:element ref="xlf:trans-unit"/>
        </xsd:choice>
        <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
      </xsd:sequence>
      <xsd:attribute name="id" type="xsd:string" use="required"/>
      <xsd:attribute name="mime-type" type="xlf:mime-typeValueList" use="required"/>
      <xsd:attribute name="approved" type="xlf:Att