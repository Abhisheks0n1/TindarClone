import React from 'react';
import { View, Text, Image } from 'react-native';
import Swiper from 'react-native-deck-swiper';
import { useQuery, useMutation } from '@tanstack/react-query';
import api from '../services/api';

const SwipeDeck = () => {
  const { data: recommended } = useQuery({
    queryKey: ['recommended'],
    queryFn: () => api.get('/recommended').then(res => res.data.data),
  });

  const likeMutation = useMutation({
    mutationFn: (id) => api.post(`/like/${id}`),
  });

  const dislikeMutation = useMutation({
    mutationFn: (id) => api.post(`/dislike/${id}`),
  });

  const renderCard = (user) => (
    <View style={{ height: 500, width: 300, backgroundColor: 'white', borderRadius: 10 }}>
      <Image source={{ uri: user.pictures[0] }} style={{ height: 400, width: 300 }} />
      <Text>{user.name}, {user.age}</Text>
      <Text>{user.location}</Text>
    </View>
  );

  return (
    <Swiper
      cards={recommended || []}
      renderCard={renderCard}
      onSwipedRight={(index) => likeMutation.mutate(recommended[index].id)}
      onSwipedLeft={(index) => dislikeMutation.mutate(recommended[index].id)}
      cardIndex={0}
      backgroundColor={'transparent'}
      stackSize={3}
      showSecondCard
      overlayLabels={{
        left: { title: 'NOPE', style: { label: { color: 'red' } } },
        right: { title: 'LIKE', style: { label: { color: 'green' } } },
      }}
    />
  );
};

export default SwipeDeck;