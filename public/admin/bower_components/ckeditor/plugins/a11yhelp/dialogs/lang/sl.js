INDX( 	                 (   �  �      u �      n             �    ` J     �    62՗b����$Ƿ���חb�62՗b�                        A u t h       �    p Z     �    ζחb����$Ƿ��sؗb�ȶחb�                        B r o a d c a s t i n g       �    X H     �    i�ؗb����$Ƿ�i�ؗb�b�ؗb�                        B u s �    ` L     �    �ٗb����$Ƿ�Yڗb��ٗb�                        C a c h e     Z    p \     �    ���b����$Ƿ�k�b����bu        1               c o m p o s e r . j s o n         ` N     �    �ڗb����$Ƿ�j�ڗb��ڗb�                        C o n f i g       ` P     �    ��ڗb����$Ƿ��ۗb���ڗb�                        C o n s o l e     h T     �    
2ۗb����$Ƿ�lܗb�2ۗb�                       	 C o n t a i n e r         ` N     �    �ܗb����$Ƿ�<�ܗb��ܗb�                        C o o k i e       h R     �    8�ܗb����$Ƿ��Vݗb�0�ܗb�      u                 D a t a b a s e           ` L     �    Phݗb����$Ƿ���ݗb�Hhݗb�                        D e b u g         h V     �    *�ݗb����$Ƿ�E�ޗb�&�ݗb�                       
 E n c r y p t i o n       ` N     �    }�ޗb����$Ƿ� Tߗb�x�ޗb�                        E v e n t s       h V     �    �fߗb����$Ƿ��%��b��fߗb�                       
 F i l e s y s t e m       h V     �    �3��b����$Ƿ�C���b��3��b�              u        
 F o u n d a t i o n       ` P     �    ���b����$Ƿ�-�b����b�                        H a s h i n g !    ` J     �    ��b����$Ƿ����b���b�                        H t t p       #    ` J     �    ���b����$Ƿ�E�b����b�                        M a i l       '    p \     �    �S�b����$Ƿ����b��S�b�                        N o t i f i c a t i o n s     *    h V     �    c��b����$Ƿ��u�b�^��b�                     u 
 P a g i n a t i o n   -    h R     �    )��b����$Ƿ����b�(��b�                        P i p e l i n e       0    ` L     �    ��b����$Ƿ�r�b���b�                        Q u e u e     :    ` L     �    ���b����$Ƿ���b�|��b�                        R e d i s     =    ` P     �    ��b����$Ƿ����b���b�                        R o u t i n g C    ` P     �    ��b����$Ƿ�*e�b���b�                        S e s s i o u E    ` P     �    Tu�b����$Ƿ���b�Tu�b�                        S u p p o r t M    h X     �    ���b����$Ƿ�-/�b����b�                        T r a n s l a t i o n P    h V     �    �=�b����$Ƿ��%�b��=�b�                       
 V a l i d a t i o n   V    ` J     �    51�b����$Ƿ���b�,1�b�                        V i e w                                                                                                                   u                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               u                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               u <?php

namespace Illuminate\Http\Testing;

class FileFactory
{
    /**
     * Create a new fake file.
     *
     * @param  string  $name
     * @param  int  $kilobytes
     * @return \Illuminate\Http\Testing\File
     */
    public function create($name, $kilobytes = 0)
    {
        return tap(new File($n