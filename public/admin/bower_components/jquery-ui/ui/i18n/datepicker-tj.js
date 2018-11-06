field']]['$gte']->sec, $testTimeout);
                }

                $fields = array(
                    $this->options['id_field'] => 'foo',
                );

                if (phpversion('mongodb')) {
                    $fields[$this->options['data_field']] = new \MongoDB\BSON\Binary('bar', \MongoDB\BSON\Binary::TYPE_OLD_BINARY);
                    $fields[$this->options['id_field']] = new \MongoDB\BSON\UTCDateTime(time() * 1000);
                } else {
                    $fields[$this->options['data_field']] = new \MongoBinData('bar', \MongoBinData::BYTE_ARRAY);
                    $fields[$this->options['id_field']] = new \MongoDate();
                }

                return $fields;
            }));

        $this->assertEquals('bar', $this->storage->read('foo'));
    }

    public function testWrite()
    {
        $collection = $this->createMongoCollectionMock();

        $this->mongo->expects($this->once())
            ->method('selectCollection')
            ->with($this->options['database'], $this->options['collection'])
            ->will($this->returnValue($collection));

        $data = array();

        $methodName = phpversion('mongodb') ? 'updateOne' : 'update';

        $collection->expects($this->once())
            ->method($methodName)
            ->will($this->retu