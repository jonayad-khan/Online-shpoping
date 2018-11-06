element>
  <xsd:element name="count">
    <xsd:complexType>
      <xsd:simpleContent>
        <xsd:extension base="xsd:string">
          <xsd:attribute name="count-type" type="xlf:AttrType_count-type" use="optional"/>
          <xsd:attribute name="phase-name" type="xsd:string" use="optional"/>
          <xsd:attribute default="word" name="unit" type="xlf:AttrType_unit" use="optional"/>
        </xsd:extension>
      </xsd:simpleContent>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="context-group">
    <xsd:complexType>
      <xsd:sequence maxOccurs="unbounded">
        <xsd:element ref="xlf:context"/>
      </xsd:sequence>
      <xsd:attribute name="name" type="xsd:string" use="optional"/>
      <xsd:attribute name="crc" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="purpose" type="xlf:AttrType_purpose" use="optional"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="context">
    <xsd:complexType>
      <xsd:simpleContent>
        <xsd:extension base="xsd:string">
          <xsd:attribute name="context-type" type="xlf:AttrType_context-type" use="required"/>
          <xsd:attribute default="no" name="match-mandatory" type="xlf:AttrType_YesNo" use="optional"/>
          <xsd:attribute name="crc" type="xsd:NMTOKEN" use="optional"/>
        </xsd:extension>
      </xsd:simpleContent>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="tool">
    <xsd:complexType mixed="true">
      <xsd:sequence>
        <xsd:any namespace="##any" processContents="strict" minOccurs="0" maxOccurs="unbounded"/>
      </xsd:sequence>
      <xsd:attribute name="tool-id" type="xsd:string" use="required"/>
      <xsd:attribute name="tool-name" type="xsd:string" use="required"/>
      <xsd:attribute name="tool-version" type="xsd:string" use="optional"/>
      <xsd:attribute name="tool-company" type="xsd:string" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="body">
    <xsd:complexType>
      <xsd:choice maxOccurs="unbounded" minOccurs="0">
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:group"/>
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:trans-unit"/>
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:bin-unit"/>
      </xsd:choice>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="group">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:sequence>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:context-group"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:count-group"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:note"/>
          <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
        </xsd:sequence>
        <xsd:choice maxOccurs="unbounded">
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:group"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:trans-unit"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:bin-unit"/>
        </xsd:choice>
      </xsd:sequence>
      <xsd:attribute name="id" type="xsd:string" use="optional"/>
      <xsd:attribute name="datatype" type="xlf:AttrType_datatype" use="optional"/>
      <xsd:attribute default="default" ref="xml:space" use="optional"/>
      <xsd:attribute name="restype" type="xlf:AttrType_restype" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:attribute name="extradata" type="xsd:string" use="optional"/>
      <xsd:attribute name="extype" type="xsd:string" use="optional"/>
      <xsd:attribute name="help-id" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="menu" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-option" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="coord" type="xlf:AttrType_Coordinates" use="optional"/>
      <xsd:attribute name="font" type="xsd:string" use="optional"/>
      <xsd:attribute name="css-style" type="xsd:string" use="optional"/>
      <xsd:attribute name="style" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="exstyle" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute default="yes" name="translate" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attribute default="yes" name="reformat" type="xlf:AttrType_reformat" use="optional"/>
      <xsd:attribute default="pixel" name="size-unit" type="xlf:AttrType_size-unit" use="optional"/>
      <xsd:attribute name="maxwidth" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minwidth" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="maxheight" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minheight" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="maxbytes" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minbytes" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="charclass" type="xsd:string" use="optional"/>
      <xsd:attribute default="no" name="merged-trans" type="xlf:AttrType_YesNo" use="option