import React from 'react';
import { RecoilRoot } from 'recoil';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import Splash from './src/pages/Splash';
import Main from './src/pages/Main';
import LikedList from './src/pages/LikedList';

const queryClient = new QueryClient();
const Stack = createStackNavigator();

const App = () => (
  <RecoilRoot>
    <QueryClientProvider client={queryClient}>
      <NavigationContainer>
        <Stack.Navigator>
          <Stack.Screen name="Splash" component={Splash} />
          <Stack.Screen name="Main" component={Main} />
          <Stack.Screen name="Liked" component={LikedList} />
        </Stack.Navigator>
      </NavigationContainer>
    </QueryClientProvider>
  </RecoilRoot>
);

export default App;