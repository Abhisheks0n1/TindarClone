import React from 'react';
import { View, Text, FlatList, Image } from 'react-native';
import { useQuery } from '@tanstack/react-query';
import api from '../services/api';

const LikedList = () => {
  const { data: liked } = useQuery({
    queryKey: ['liked'],
    queryFn: () => api.get('/liked').then(res => res.data),
  });

  const renderItem = ({ item }) => (
    <View style={{ height: 500, width: 300, margin: 10 }}>
      <Image source={{ uri: item.pictures[0] }} style={{ height: 400, width: 300 }} />
      <Text>{item.name}, {item.age}</Text>
      <Text>{item.location}</Text>
    </View>
  );

  return (
    <FlatList
      data={liked}
      renderItem={renderItem}
      keyExtractor={item => item.id.toString()}
    />
  );
};

export default LikedList;