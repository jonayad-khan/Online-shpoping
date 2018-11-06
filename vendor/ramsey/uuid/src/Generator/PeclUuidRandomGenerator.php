d:keyref name="KR_segsrc_ex_rid" refer="xlf:U_segsrc_bx_rid">
      <xsd:selector xpath=".//xlf:ex"/>
      <xsd:field xpath="@rid"/>
    </xsd:keyref>
  </xsd:element>
  <xsd:element name="target">
    <xsd:complexType mixed="true">
      <xsd:group maxOccurs="unbounded" minOccurs="0" ref="xlf:ElemGroup_TextContent"/>
      <xsd:attribute name="state" type="xlf:AttrType_state" use="optional"/>
      <xsd:attribute name="state-qualifier" type="xlf:AttrType_state-qualifier" use="optional"/>
      <xsd:attribute name="phase-name" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute ref="xml:lang" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:attribute name="coord" type="xlf:AttrType_Coordinates" use="optional"/>
      <xsd:attribute name="font" type="xsd:string" use="optional"/>
      <xsd:attribute name="css-style" type="xsd:string" use="optional"/>
      <xsd:attribute name="style" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="exstyle" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute default="yes" name=