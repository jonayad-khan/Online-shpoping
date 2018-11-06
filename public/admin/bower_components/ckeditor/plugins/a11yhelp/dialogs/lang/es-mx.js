on>
      <xsd:documentation>Values for the attribute 'coord'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:string">
      <xsd:pattern value="(-?\d+|#);(-?\d+|#);(-?\d+|#);(-?\d+|#)"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_Version">
    <xsd:annotation>
      <xsd:documentation>Version values: 1.0 and 1.1 are allowed for backward compatibility.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="1.2"/>
      <xsd:enumeration value="1.1"/>
      <xsd:enumeration value="1.0"/>
    </xsd:restriction>
  </xsd:simpleType>
  <!-- Groups -->
  <xsd:group name="ElemGroup_TextContent">
    <xsd:choice>
      <xsd:element ref="xlf:g"/>
      <xsd:element ref="xlf:bpt"/>
      <xsd:element ref="xlf:ept"/>
      <xsd:element ref="xlf:ph"/>
      <xsd:element ref="xlf:it"/>
      <xsd:element ref="xlf:mrk"/>
      <xsd:element ref="xlf:x"/>
      <xsd:element ref="xlf:bx"/>
      <xsd:element ref="xlf:ex"/>
    </xsd:choice>
  </xsd:group>
  <xsd:attributeGroup name="AttrGroup_TextContent">
    <xsd:attribute name="id" type="xsd:string" use="required"/>
    <xsd:attribute name="xid" type="xsd:string" use="optional"/>
    <xsd:attribute name="equiv-text" type="xsd:string" use="optional"/>
    <xsd:anyAttribute namespace="##other" processContents="strict"/>
  </xsd:attributeGroup>
  <!-- XLIFF Structure -->
  <xsd:element name="xliff">
    <xsd:complexType>
      <xsd:sequence maxOccurs="unbounded">
        <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
        <xsd:element ref="xlf:file"/>
      </xsd:sequence>
      <xsd:attribute name="version" type="xlf:AttrType_Version" use="required"/>
      <xsd:attribute ref="xml:lang" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="file">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:element minOccurs="0" ref="xlf:header"/>
        <xsd:element ref="xlf:body"/>
      </xsd:sequence>
      <xsd:attribute name="original" type="xsd:string" use="required"/>
      <xsd:attribute name="source-language" type="xsd:language" use="required"/>
      <xsd:attribute name="datatype" type="xlf:AttrType_datatype" use="required"/>
      <xsd:attribute name="tool-id" type="xsd:string" use="optional"/>
      <xsd:attribute name="date" type="xsd:dateTime" use="optional"/>
      <xsd:attribute ref="xml:space" use="optional"/>
      <xsd:attribute name="category" type="xsd:string" use="optional"/>
      <xsd:attribute name="target-language" type="xsd:language" use="optional"/>
      <xsd:attribute name="product-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="product-version" type="xsd:string" use="optional"/>
      <xsd:attribute name="build-num" type="xsd:string" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_group_id">
      <xsd:selector xpath=".//xlf:group"/>
      <xsd:field xpath="@id"/>
    </xsd:unique>
    <xsd:key name="K_unit_id">
      <xsd:selector xpath=".//xlf:trans-unit|.//xlf:bin-unit"/>
      <xsd:field xpath="@id"/>
    </xsd:key>
    <xsd:keyref name="KR_unit_id" refer="xlf:K_unit_id">
      <xsd:selector xpath=".//bpt|.//ept|.//it|.//ph|.//g|.//x|.//bx|.//ex|.//sub"/>
      <xsd:field xpath="@xid"/>
    </xsd:keyref>
    <xsd:key name="K_tool-id">
      <xsd:selector xpath="xlf:header/xlf:tool"/>
      <xsd:field xpath="@tool-id"/>
    </xsd:key>
    <xsd:keyref name="KR_file_tool-id" refer="xlf:K_tool-id">
      <xsd:selector xpath="."/>
      <xsd:field xpath="@tool-id"/>
    </xsd:keyref>
    <xsd:keyref name="KR_phase_tool-id" refer="xlf:K_tool-id">
      <xsd:selector xpath="xlf:header/xlf:phase-group/xlf:phase"/>
      <xsd:field xpath="@tool-id"/>
    </xsd:keyref>
    <xsd:keyref name="KR_alt-trans_tool-id" refer="xlf:K_tool-id">
      <xsd:selector xpath=".//xlf:trans-unit/xlf:alt-trans"/>
      <xsd:field xpath="@tool-id"/>
    </xsd:keyref>
    <xsd:key name="K_count-group_name">
      <xsd:selector xpath=".//xlf:count-group"/>
      <xsd:field xpath="@name"/>
    </xsd:key>
    <xsd:unique name="U_context-group_name">
      <xsd:selector xpath=".//xlf:context-group"/>
      <xsd:field xpath="@name"/>
    </xsd:unique>
    <xsd:key name="K_phase-name">
      <xsd:selector xpath="xlf:header/xlf:phase-group/xlf:phase"/>
      <xsd:field xpath="@phase-name"/>
    </xsd:key>
    <xsd:keyref name="KR_phase-name" refer="xlf:K_phase-name">
      <xsd:selector xpath=".//xlf:count|.//xlf:trans-unit|.//xlf:target|.//bin-unit|.//bin-target"/>
      <xsd:field xpath="@phase-name"/>
    </xsd:keyref>
    <xsd:unique name="U_uid">
      <xsd:selector xpath=".//xlf:external-file