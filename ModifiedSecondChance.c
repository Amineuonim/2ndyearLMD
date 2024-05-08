#include<stdio.h>
#include<stdlib.h>

#define number_of_slots 3
#define NUM_REQUESTS 15

typedef struct page{
    int pid;
    int reference_bit;
} page;

typedef struct slot{
    page page;
    int update_time;
    struct slot * next;
} slot;



slot * get_oldest(slot*node , int minimum_start){

  if(node==NULL){
    (void)printf("\nerror in get_oldest() node is null.\n");
    exit(5);
    }
    
  slot* temp = node;  slot * old =node;   int i=1;

  while(temp!=NULL && i <= number_of_slots){
    if(old->update_time < temp->update_time && old->update_time > minimum_start){
      old = temp;
    }
    temp = temp->next;
    }
  return old;


}

void initialize_memory(slot *node) {
  int counter = 0;

  if(NULL == node){
    (void)printf("\nerror at initialize memory function.\n");
    exit(5);
  }

  for (int i = 0; i < number_of_slots; i++) {
    if(NULL == &node[i]){
      (void)printf("\nerror detected at initialize_memory())\nnode indexing overflew at %d\n",i);
      exit(5);
    }
    node[i].page.pid = -1;  
    node[i].page.reference_bit = 0;
    node[i].update_time = 0;

    }
  return;
}

void slot_assign(slot* node, int pid, int time) {
  if (NULL == node) {
    (void)printf("\nerror Node is NULL in slot_assign.\n");
    exit(5);
    }
  
  int i=0;  slot *temp = NULL; int current_min_time = -1;

  // check for duplication
  for (i = 0; i < number_of_slots; i++) {
    if (node[i].page.pid == pid) {
      node[i].page.reference_bit +=1;
      (void)printf("increased pid: %d refrence bit at slot %d.\n",pid,i);    
      (void)printf("refrence of pid: %d is now %d\n\n",pid,node[i].page.reference_bit);
      return;  
    }
    }

  // check for empty slots
  for (i = 0; i < number_of_slots; i++) {
    if (node[i].page.pid == -1) {
      node[i].page.pid = pid;
      node[i].page.reference_bit = 0;
      node[i].update_time = time;
      (void)printf("assigned pid: %d at empty slot %d.\n",pid,i);  

    return;
    }
    }

  // no empty slots or duplication detected
  /* loop will iterate and auromatically decrease the refrence bits
  in first come first served manner following the update time*/

// sort on update time
  for (int step = 0; step < number_of_slots - 1; ++step) {
    for (int i = 0; i < number_of_slots - step - 1; ++i) {
      if (node[i].update_time > node[i + 1].update_time) {
        slot temp = node[i];
        node[i] = node[i + 1];
        node[i + 1] = temp;
        }
    }
    }


  for(int j=0 ; j<number_of_slots ; j++){
    for(i=0; i < number_of_slots; i++){
      if(node[i].page.reference_bit == 0){
        (void)printf("changed pid: %d for pid:%d in slot %d\n",node[i].page.pid,pid,i);
        node[i].page.pid=pid;
        node[i].update_time=time;
        return;
      }
      else{
        node[i].page.reference_bit -= 1;
        (void)printf("decreased refrence of pid:%d in slot %d\n",node[i].page.pid,i);
        (void)printf("new refrence is :%d\n",node[i].page.reference_bit);
      }
  }
  }


  return;
}


int main() {
  slot memory[number_of_slots];

    // Initialize memory
  initialize_memory(memory);

    // Array of process IDs to simulate page requests
  int process_ids[NUM_REQUESTS] = {0,1,2,0,1,2,0,5,4,5,3,5,6,2,3};

    // Simulate page requests and slot assignments
  int time = 0;
  for (int i = 0; i < NUM_REQUESTS; i++) {
    time++; // Increment time for each request
    (void)printf("\nstep :%d)\n",i+1);
    slot_assign(memory, process_ids[i], time);
    }

    // Print the final state of memory after all requests
  (void)printf("\nFinal State of Memory:\n");
  for (int i = 0; i < number_of_slots; i++) {
    (void)printf("Slot %d: PID = %d, Reference Bit = %d, Update Time = %d\n",
    i+1, memory[i].page.pid, memory[i].page.reference_bit, memory[i].update_time);
    }

    return 0;
}
