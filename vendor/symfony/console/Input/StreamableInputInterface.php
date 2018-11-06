"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="ex">
    <xsd:complexType>
      <xsd:attribute name="rid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="ph">
    <xsd:complexType mixed="true">
      <xsd:sequence maxOccurs="unbounded" minOccurs="0">
        <xsd:element ref="xlf:sub"/>
      </xsd:sequence>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlinePlaceholders" use="optional"/>
      <xsd:attribute name="crc" type="xsd:string" use="optional"/>
      <xsd:attribute name="assoc" type="xlf:AttrType_assoc" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="bpt">
    <xsd:complexType mixed="true">
      <xsd:sequenc