    $mock->nonNullableClass();
    }

    /**
     * @test
     */
    public function itShouldAllowNullalbeClassToBeSet()
    {
        $mock = mock("test\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableClass')->andReturn(new MethodWithNullableReturnType());
        $mock->nullableClass();
    }

    /**
     * @test
     */
    public function itShouldAllowNullableClassToBeNull()
    {
        $mock = mock("test\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableClass')->andReturn(null);
        $mock->nullableClass();
    }

    /** @test */
    public function it_allows_returning_null_for_nullable_object_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableClass")->andReturnNull();

        $this->assertNull($double->nullableClass());
    }

    /** @test */
    public function it_allows_returning_null_for_nullable_string_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableString")->andReturnNull();

        $this->assertNull($double->nullableString());
    }

    /** @test */
    public function it_allows_returning_null_for_nullable_int_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableInt")->andReturnNull();

        $this->assertNull($double->nullableInt());
    }

    /** @test */
    public function it_returns_null_on_calls_to_ignored_methods_of_spies_if_return_type_is_nullable()
    {
        $double = \Mockery::spy(MethodWithNullableReturnType::class);

        $this->assertNull($double->nullableClass());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          �PNG

   IHDR  �  ]   �ݽ�   sRGB ���   gAMA  ���a   	pHYs  �  ��o�d  �IDATx^�ݹoT��qҦB2NED��(��"��҄%R�2�U�@$+$&
Q�5+�P@J� �����?����\����Y�����H���k����̽g&S*  $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $� $����s���P����� J(@H
�իW�A(@(� !)ܗ/_� ���$
�W��/��ÇG~[�O $������ ��a���I��P�PDBR�ϟ?'BBI��P�PDB�+ Q���gψ�P�PDB�+ Q���ӧO��P�PDB�+ Q��D�
E $������  Q��D�
E $�����c�  Q��D�
E $Q��BBIa�>z�8E $Q��BBIa�>|��8E $Q��BBI��aÆʔ)S��6mZ�ԩS��TBBIa�>x�@.�Ν�tuuehپ}{�X�P�PDB�r���O5�g�1cF������BBIa�޿_*w�ޭ,[�,+�/��2+����G?G! Q���Z�gϞ�..Z��r���� W�^��P�PDBR���ݓʮ]���۶m[M!�f��'OF?�{(@(� !I� o߾]�3gNM�ݹs'�$J1���CBI�x��Ѭ����͛7��?+�\) Q���m*Qɺu벢���o��ߺu���'j>O! Q���V�o+�|9�Z����BBIa��=4�9r$+��V_�7ڟ��#._�\���CBIJh�_�.]��֭[�8����g��}���q��P�PDB�R���?5/u8~�x���k�f{��9 Q���������5�v�ڵ�qV�8+�cǎE��
�(@HR)@���dɒ����g�8ˍ7j.��u��P�PDBR�v�s:��D3}���ŋ�_�[(@(� !I� ׬Y-��f�޽ѯ�- Q���P���e����boV�\���BBIa��=6�����r���P����ܹ3������_�=�S(@(� !I� �?W�X=&�3g�TfΜ�}�-[��y
E $��k/ ��ӧOה؞={���b�N/^�}���;�K(@(� !�{�/c�������q�%����h� ���$�X��.Ǝ+�� '�5�
�(@H
�^<�-��wMy������Ɗ�[L�D�Y���@�X� ���$��cǎ�ׁ��c�L��+ Q���]n�۬2k֬��>����q�I�ך?~��ab�
�(@H�Z����"
����{e��P�PDB�+ Q��D�
E $��{��U�  Q��D�
E $��{���  Q��D�
E $Q��BBIa�ڻ���CBI��P�PDBR��.]"BBI��P�PDB�+ Q�����H� ���$
�W(@(� !)ܡ�!�  Q��D�
E $Q��BBIa�� ���$
�W(@(� !)܁��  Q��D�
E $��{���  Q��D�
E $����̞=�����3O��Ѿ�؟�: �P�����ԩS+S�L�tvvF��C�{�ﱣ�#��% Jc�ƍo�f�O>����ￏ�!�7oξ�ŋG�ig �(@�F�
𫯾�J��=v��x�~�(@�F___ӳ~���L>����1��V��w�}��3Ďiu(@xG����uww�|TǼy�߻��_��(��"�0l'���S�@��3 �D��/<{�g��Ο?�=�]�|��G
����S-����'Of?ϦM�F>
�rv�ޝ���{Y���A#��^(	{X6v	�~6�$Z�g�@�(@�����w|�W�j�æ��D�R�-i?[x�4�Y��Q�H^j��cg(�
IK��X������|H�d��3Ҋ/��V�@j(@$�������H��p�V� ��P��DRR��9^�E�(@$��CBϊ�"
��~�����P�H�9>�EJ(@�^���7���2RA�Ը�59lB
(@��'�����8���
�bx}����eG�����lB�Q�(v26�m
��r@YP�(^��<�FQ�(�Y���Ceg(ʆD)������� Q
��l�e�L(@���T{�3eABZ~�";>�'��΃�� !�g"�������3���ᑏ:(@H�^T��
u ��{�~��PBB
�:��g�������|���v|���X(� !����͞���N����ah`g(�P�p��:�G% \cǧv�B�x6�+�3���Q�p+?�Mz�o�(@�Ď�r�e+���;<s(�wJ������+�{G��H9p/^Q�p�݃�el���
.�,����{��kag(<� �� ����
�c�gZ�
/(@�gibg(<� Qv|��{���D!���&v��h ڎG��;C{{{G>
�������B	����|h=
m�@İ.P
mÎO�%\����� ڂD[�. x+=+?[#V�@�Q�h9v�a�X+h'
-ŎOL�m���bag(Z�DK�����P���ag��A�Q�h	v|���V� �t�{8��D#�;C�r:�L ��]|h6�Z�D����:.4���
 ���5h%��J��Xh��`�ځu�f� �0^��v�+����DCx����^���P4�Ĥ�;Ea��(@L
;>Q4v��Q &������h�	c'<ɯ���ᑏoGbB���	��ɢ 1n�s�W��/l�����(06
�®;xgk4<@����(0:
o�뮠���
c��
�س�P�l��X(@���Pd�úeg(FCbT��
��r�� Ž�cg(ކ���`g(�B�;>Q6\��h(@d�o��bg(b(@d�;�(������*!��z �G�d��y`��%���kZÚ�׺"]`�x�R�U
0Q�A�x�?P����J����<�A`z(����WB�F&�{@-v���L;>�8v���LD�Q.;>�7寎����|eF&�����34-`���_x������Rr`���+=+�p��E�;>��agh(��bW��Ρ��ޑ��L(���+�V|��Z>`ɰ�h.X2�������D��T��`gh9Q�%��O����^>`	�w���h����M}�8��e2C	�ˍ���}	��o/
P;Ӏb���?�'�&
P�@�bY����#� ���܃�F���	_x	�.
P�6������O�7��� E������z(@<�4�3T�\��;>����{zzF>
�(@��]h���@:a��d��������.{�J0ܺ��;��(�D8Y�츏 �C(<;�������\��t"���_~a'P�;C�����ţ �?�Q";>�r�g~኎=#���]<
Ёp�3<R�ػIأG����a筽]����A����߯��ˠţ �?C�o�^}�Cx�h�%�{ �];�����p�x`��#�w�y�����{��$���.��e �|���?���g!\-X��+W֜!��О�	�e�]�����g���"P���h�y�,P>v^�˚�绝�(X����>����
� ;�?������2hq$p�ܹ�HWWW������D�\-@��֟Z켷��.���\1j(@Ҵ �[����.�W�^Q]����� ]�/_�$������+�3�$'�>����>|x�43�WTg�t�x�8H�}؂�hf���� 
�4��]� _Q�����s� ������:(@�pT?t1|EuP���.~�b����.�gϞQ]�����@��������+�3@� �>}JDu�C3�WTg H���.f���� 
�4��]� _Q������ ������:(@�pT?t1|EuH��Ǐ���.~�b���� I�Q]�����@��������+�3@� =zDDu�C3�WTg H���.f���� �|��!q��]� _Q� i8������:(�����L�2eB�6mZ�ԩSѯ�9���f�XٰaCtX�����x���.���o��]��I(������]
3�>�Ν�tuuE��X�������@�(��E�U?t)̀|�z�7Vf̘Q�~�z�kz���.����ͯ���-�E�Unݺ=.�]�v����]�=�ST?t)� �ݻw+˖-�9�-�̈́�gϾ�,Qa�� 
�E�LZ�O����G����]
3��~���\��,�0�z���q^�:��޽{ns��њE����q��O[��c<Eu�C���0;�9�/A�%r����q�:(����/|
x��p�Ν�K�v��ի�cG��۷+s�̑��3�lQ(@
��}�?�۶m[���%?&�5�� ]�v��k�9�-܅Vnܸ=.�u��e��o߾�1������������a�