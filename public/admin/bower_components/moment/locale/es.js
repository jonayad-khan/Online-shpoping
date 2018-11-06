 <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because of incorrect grammar.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected-inaccurate">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because it is incorrect.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected-length">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because it is too long or too short.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected-spelling">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because of incorrect spelling.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="tm-suggestion">
        <xsd:annotation>
          <xsd:documentation>Indicates the translation is suggested by translation memory.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="unitValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'unit'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="word">
        <xsd:annotation>
          <xsd:documentation>Refers to words.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="page">
        <xsd:annotation>
          <xsd:documentation>Refers to pages.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="trans-unit">
        <xsd:annotation>
          <xsd:documentation>Refers to &lt;trans-unit&gt; elements.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="bin-unit">
        <xsd:annotation>
          <xsd:documentation>Refers to &lt;bin-unit&gt; elements.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="glyph">
        <xsd:annotation>
          <xsd:documentation>Refers to glyphs.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="item">
        <xsd:annotation>
          <xsd:documentation>Refers to &lt;trans-unit&gt; and/or &lt;bin-unit&gt; elements.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="instance">
        <xsd:annotation>
          <xsd:documentation>Refers to the occurrences of instances defined by the count-type value.</xsd:documentation>
        </xsd:annotatio